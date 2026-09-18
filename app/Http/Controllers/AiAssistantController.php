<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiAssistantController extends Controller
{
    /**
     * Hiển thị trang giao diện Trợ Lý AI với dữ liệu khởi tạo từ database
     */
    public function index()
    {
        $allListings = Listing::with(['profile', 'skills'])->latest()->get();

        $initialJobs = $allListings->map(function ($job) {
            return $this->formatJobData($job, 100);
        });

        $suggestedTitles = $allListings->pluck('job_title')->filter()->unique()->values()->all();
        $suggestedLocations = $allListings->pluck('address')->filter()->unique()->values()->all();
        $suggestedJobTypes = $allListings->pluck('job_type')->filter()->unique()->values()->all();

        return view('assistant', compact('initialJobs', 'suggestedTitles', 'suggestedLocations', 'suggestedJobTypes'));
    }

    /**
     * Chuẩn hóa chuỗi tiếng Việt không dấu để so khớp linh hoạt
     */
    private function normalizeText($value = '')
    {
        if (empty($value)) return '';
        $str = mb_strtolower(trim($value), 'UTF-8');
        
        $unicode = [
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd' => 'đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i' => 'í|ì|ỉ|ĩ|ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
        ];

        foreach ($unicode as $nonAccent => $accent) {
            $str = preg_replace("/($accent)/i", $nonAccent, $str);
        }

        return $str;
    }

    /**
     * Tách chuỗi thành mảng token từ khóa
     */
    private function getTokens($value = '')
    {
        $normalized = $this->normalizeText($value);
        return array_values(array_filter(preg_split('/\s+/', $normalized)));
    }

    /**
     * Gọi Gemini API có hỗ trợ retry khi gặp 429/503
     */
    private function callGeminiWithRetry($url, $payload, $maxRetries = 2, $initialDelayMs = 1500)
    {
        $delay = $initialDelayMs;
        for ($attempt = 1; $attempt <= $maxRetries; $attempt++) {
            try {
                $response = Http::timeout(25)->withHeaders([
                    'Content-Type' => 'application/json'
                ])->post($url, $payload);

                if ($response->successful()) {
                    return $response;
                }

                $status = $response->status();
                if (($status === 429 || $status === 503) && $attempt < $maxRetries) {
                    usleep($delay * 1000);
                    $delay *= 2;
                } else {
                    return $response;
                }
            } catch (\Exception $e) {
                if ($attempt >= $maxRetries) {
                    throw $e;
                }
                usleep($delay * 1000);
                $delay *= 2;
            }
        }
        return null;
    }

    /**
     * Xử lý tin nhắn chat từ người dùng, tương tác Gemini & truy vấn CSDL
     */
    public function chat(Request $request)
    {
        try {
            $messages = $request->input('messages');

            if (!is_array($messages) || empty($messages)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Lịch sử trò chuyện không hợp lệ'
                ], 400);
            }

            $apiKey = config('services.gemini.api_key') ?: env('GEMINI_API_KEY');
            $model = config('services.gemini.model') ?: 'gemini-2.5-flash';

            // Lấy danh sách việc làm thực tế từ bảng listings
            $allListings = Listing::with(['profile', 'skills'])->latest()->get();

            // Tổng hợp thông tin các công việc hiện có trong CSDL để nạp vào prompt cho Gemini
            $dbJobSummaries = $allListings->map(function ($l) {
                $sal = is_numeric($l->salary) ? number_format((float)$l->salary, 0, ',', '.') . ' VNĐ' : ($l->salary ?: 'Thỏa thuận');
                return "- ID: {$l->id} | Vị trí (job_title): '{$l->job_title}' | Mức lương (salary): '{$sal}' | Địa điểm (address): '{$l->address}' | Hình thức (job_type): '{$l->job_type}' | Mô tả: '{$l->predes}'";
            })->implode("\n");

            // System prompt hướng dẫn Gemini NLU phân tích dựa trên CSDL thực tế
            $systemPrompt = <<<PROMPT
Bạn là Trợ lý AI Tìm Việc Thông Minh (AI Job Assistant) của nền tảng tuyển dụng "JOB SEARCH".
Nhiệm vụ của bạn là lắng nghe, trò chuyện thân thiện và hỗ trợ ứng viên tìm kiếm công việc phù hợp nhất DỰA VÀO CƠ SỞ DỮ LIỆU THỰC TẾ (bảng listings) CỦA HỆ THỐNG.

=== DANH SÁCH CÔNG VIỆC THỰC TẾ ĐANG CÓ TRONG CƠ SỞ DỮ LIỆU (BẢNG LISTINGS) ===
{$dbJobSummaries}
================================================================================

4 TIÊU CHÍ VIỆC LÀM TƯƠNG ỨNG TRONG BẢNG LISTINGS:
1. Vị trí công việc: trường `job_title`
2. Mức lương: trường `salary`
3. Địa điểm / Nơi làm việc: trường `address`
4. Hình thức làm việc: trường `job_type`

QUY TẮC XỬ LÝ:
1. Phân tích tin nhắn mới nhất và lịch sử trò chuyện.
2. Trích xuất các tiêu chí của người dùng:
   - position: Vị trí người dùng mong muốn (ví dụ: "Frontend Developer", "chụp ảnh", v.v.) hoặc null.
   - location: Nơi làm việc người dùng mong muốn (ví dụ: "an dong", "Hải Phòng", v.v.) hoặc null.
   - salary: Mức lương mong muốn hoặc null.
   - job_type: Hình thức ("Fulltime", "Parttime", "Từ Xa", v.v.) hoặc null.
   - matched_job_ids: Mảng chứa các ID công việc trong danh sách trên khớp nhất với yêu cầu của người dùng (Ví dụ: [36] nếu người dùng tìm Frontend, [35] nếu tìm chụp ảnh, [39] nếu tìm thể thao). Nếu người dùng hỏi chung hoặc chưa nêu vị trí cụ thể, trả về các ID công việc tiêu biểu.
3. Trong "ai_message":
   - Luôn trả lời bằng tiếng Việt thân thiện, rõ ràng, nhiệt tình.
   - Nêu rõ các thông tin công việc từ CSDL: vị trí (job_title), mức lương (salary), địa điểm (address) và hình thức (job_type).
4. Trong "quick_replies":
   - Đưa ra 3-5 lựa chọn nhanh dựa CHÍNH XÁC trên các công việc thực tế trong CSDL (ví dụ: "Frontend Developer", "Chụp ảnh cưới", "Thể thao 24h", "Fulltime", "Parttime", "An Đồng").
5. ĐỊNH DẠNG BẮT BUỘC: Bạn CHỈ ĐƯỢC trả về DUY NHẤT một chuỗi JSON hợp lệ, KHÔNG có markdown hay ký tự bao bọc bên ngoài.

Ví dụ JSON trả về:
{
  "status": "complete",
  "position": "Frontend Developer",
  "location": "an dong",
  "salary": "3.000 VNĐ",
  "job_type": "Fulltime",
  "matched_job_ids": [36],
  "ai_message": "Dạ tuyệt vời! Trong hệ thống đang có vị trí 'Frontend Developer' tại khu vực An Đồng, hình thức Fulltime với mức lương 3.000 VNĐ đang tuyển dụng. Tôi đã hiển thị chi tiết công việc này ngay bên bảng kết quả để bạn xem và ứng tuyển ngay nhé!",
  "quick_replies": ["Xem việc Fulltime khác", "Việc tại An Đồng", "Tìm việc Parttime"]
}
PROMPT;

            $geminiText = '';
            $parsed = null;

            if ($apiKey) {
                $geminiUrl = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}";

                $response = $this->callGeminiWithRetry($geminiUrl, [
                    'contents' => $messages,
                    'systemInstruction' => [
                        'parts' => [
                            ['text' => $systemPrompt]
                        ]
                    ],
                    'generationConfig' => [
                        'responseMimeType' => 'application/json',
                        'temperature' => 0.2
                    ]
                ]);

                if ($response && $response->successful()) {
                    $geminiBody = $response->json();
                    $geminiText = $geminiBody['candidates'][0]['content']['parts'][0]['text'] ?? '';
                    if (!empty($geminiText)) {
                        $parsed = json_decode(trim($geminiText), true);
                    }
                } else {
                    Log::warning("Gemini API call failed or rate limited. Falling back to local search.");
                }
            }

            // Lấy tin nhắn người dùng mới nhất để tăng cường trích xuất từ khóa
            $lastUserMessage = '';
            for ($i = count($messages) - 1; $i >= 0; $i--) {
                if (($messages[$i]['role'] ?? '') === 'user') {
                    $lastUserMessage = $messages[$i]['parts'][0]['text'] ?? '';
                    break;
                }
            }

            // Trích xuất các tiêu chí
            $status = $parsed['status'] ?? 'complete';
            $position = $parsed['position'] ?? null;
            $location = $parsed['location'] ?? null;
            $salary = $parsed['salary'] ?? null;
            $jobType = $parsed['job_type'] ?? null;
            $matchedJobIds = $parsed['matched_job_ids'] ?? [];
            $aiMessage = $parsed['ai_message'] ?? null;
            $quickReplies = $parsed['quick_replies'] ?? [];

            // Nếu không có tin nhắn AI từ Gemini, tự tạo phản hồi thông minh dựa trên CSDL
            if (empty($aiMessage)) {
                $aiMessage = "Tôi đã tìm kiếm các cơ hội việc làm trong hệ thống theo yêu cầu của bạn. Dưới đây là danh sách việc làm phù hợp nhất!";
            }

            // Nếu không có quick replies, tạo từ dữ liệu thực tế
            if (empty($quickReplies)) {
                $quickReplies = $allListings->pluck('job_title')->filter()->take(4)->values()->all();
            }

            // =========================================================================
            // THUẬT TOÁN CHẤM ĐIỂM & SO KHỚP CÔNG VIỆC CHÍNH XÁC VỚI BẢNG LISTINGS
            // Các trường kiểm tra: job_title, salary, address, job_type
            // =========================================================================
            $positionTokens = array_merge(
                $this->getTokens($position),
                $this->getTokens($lastUserMessage)
            );
            $positionTokens = array_unique(array_filter($positionTokens));

            $locationTokens = $this->getTokens($location);
            $jobTypeTokens = $this->getTokens($jobType);

            $scoredJobs = [];

            foreach ($allListings as $job) {
                $score = 0;
                $jobTitleNorm = $this->normalizeText($job->job_title);
                $jobDescNorm = $this->normalizeText($job->description . ' ' . $job->predes . ' ' . $job->roles);
                $jobAddressNorm = $this->normalizeText($job->address);
                $jobTypeNorm = $this->normalizeText($job->job_type);

                // Ưu tiên 1: Gemini đã xác định cụ thể ID việc làm này (+50 điểm)
                if (in_array($job->id, $matchedJobIds)) {
                    $score += 50;
                }

                // Tiêu chí 1: Vị trí (job_title) - Trọng số cao nhất (+45 điểm)
                $titleMatched = false;
                foreach ($positionTokens as $token) {
                    if (mb_strlen($token) < 2) continue;
                    if (str_contains($jobTitleNorm, $token)) {
                        $score += 35;
                        $titleMatched = true;
                    } elseif (str_contains($jobDescNorm, $token)) {
                        $score += 15;
                        $titleMatched = true;
                    }
                }

                // Tiêu chí 2: Địa điểm (address) (+25 điểm)
                if (!empty($locationTokens)) {
                    foreach ($locationTokens as $locToken) {
                        if (str_contains($jobAddressNorm, $locToken) || str_contains($locToken, $jobAddressNorm)) {
                            $score += 25;
                            break;
                        }
                    }
                } else {
                    // Nếu người dùng nhắc đến địa điểm trong câu chat
                    $chatTokens = $this->getTokens($lastUserMessage);
                    foreach ($chatTokens as $cToken) {
                        if (mb_strlen($cToken) >= 3 && str_contains($jobAddressNorm, $cToken)) {
                            $score += 20;
                            if (!$location) $location = $job->address;
                            break;
                        }
                    }
                }

                // Tiêu chí 3: Hình thức (job_type) (+20 điểm)
                if (!empty($jobTypeTokens)) {
                    foreach ($jobTypeTokens as $jtToken) {
                        if (str_contains($jobTypeNorm, $jtToken) || str_contains($jtToken, $jobTypeNorm)) {
                            $score += 20;
                            break;
                        }
                    }
                } else {
                    // Kiểm tra từ khóa hình thức trong câu chat
                    $userTextNorm = $this->normalizeText($lastUserMessage);
                    if (str_contains($userTextNorm, 'full') || str_contains($userTextNorm, 'toan thoi gian')) {
                        if (str_contains($jobTypeNorm, 'full')) $score += 20;
                    } elseif (str_contains($userTextNorm, 'part') || str_contains($userTextNorm, 'ban thoi gian')) {
                        if (str_contains($jobTypeNorm, 'part')) $score += 20;
                    }
                }

                // Tiêu chí 4: Mức lương (salary) (+10 điểm)
                if ($salary) {
                    $score += 10;
                }

                $scoredJobs[] = [
                    'job' => $job,
                    'score' => $score,
                    'titleMatched' => $titleMatched,
                ];
            }

            // Sắp xếp danh sách việc làm theo điểm số giảm dần
            usort($scoredJobs, function ($a, $b) {
                return $b['score'] <=> $a['score'];
            });

            // Tách danh sách việc làm khớp (matched) và việc làm tham khảo (alternative)
            $matched = [];
            $alternatives = [];

            // Kiểm tra xem người dùng có yêu cầu vị trí cụ thể không
            $hasSpecificPosition = (!empty($position) && mb_strlen(trim($position)) > 1) || count($positionTokens) > 0;

            foreach ($scoredJobs as $item) {
                if ($hasSpecificPosition) {
                    // Nếu người dùng tìm kiếm vị trí cụ thể: công việc phải khớp vị trí hoặc được Gemini chỉ định
                    if ($item['titleMatched'] || in_array($item['job']->id, $matchedJobIds)) {
                        $matched[] = $item;
                    } else {
                        $alternatives[] = $item;
                    }
                } else {
                    // Nếu hỏi chung hoặc chỉ lọc theo địa điểm / hình thức
                    if ($item['score'] >= 25) {
                        $matched[] = $item;
                    } else {
                        $alternatives[] = $item;
                    }
                }
            }

            // Nếu không có job nào khớp sâu, hiển thị các job nổi bật
            if (empty($matched)) {
                $matched = array_slice($scoredJobs, 0, 4);
                $alternatives = array_slice($scoredJobs, 4);
            }

            $matchedJobs = array_map(function ($item) {
                $calcScore = max(70, min(99, $item['score'] > 0 ? $item['score'] : 80));
                return $this->formatJobData($item['job'], $calcScore);
            }, $matched);

            $alternativeJobs = array_map(function ($item) {
                return $this->formatJobData($item['job'], 60);
            }, array_slice($alternatives, 0, 4));


            return response()->json([
                'success' => true,
                'status' => $status,
                'ai_message' => $aiMessage,
                'quick_replies' => $quickReplies,
                'position' => $position,
                'location' => $location,
                'salary' => $salary,
                'job_type' => $jobType,
                'matched_jobs' => $matchedJobs,
                'alternative_jobs' => $alternativeJobs,
            ]);

        } catch (\Exception $e) {
            Log::error("AiAssistantController chat Exception: " . $e->getMessage() . "\n" . $e->getTraceAsString());
            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi trong quá trình xử lý: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Định dạng dữ liệu job trả về cho giao diện Frontend với đầy đủ thông tin từ bảng listings:
     * job_title, salary, address, job_type, predes, description, v.v.
     */
    private function formatJobData($job, $matchScore = 85)
    {
        $companyName = $job->profile ? ($job->profile->name ?? 'Doanh nghiệp') : 'Doanh nghiệp';
        $companyAvatar = $job->profile && $job->profile->profile_pic 
            ? asset('storage/' . $job->profile->profile_pic)
            : asset('image/logo-jobsearch.png');

        $featureImg = $job->feature_image 
            ? asset('storage/' . $job->feature_image)
            : null;

        // Định dạng mức lương giống chuẩn trong job/show.blade.php
        if (is_numeric($job->salary) && (float) $job->salary > 0) {
            $salaryDisplay = number_format((float) $job->salary, 0, ',', '.') . ' VNĐ';
        } else {
            $salaryDisplay = $job->salary ?: 'Thỏa thuận';
        }

        $jobTitle = $job->job_title ?: ($job->title ?: 'Vị trí chưa cập nhật');

        return [
            'id' => $job->id,
            'job_title' => $jobTitle,
            'title' => $jobTitle,
            'slug' => $job->slug,
            'company_name' => $companyName,
            'company_avatar' => $companyAvatar,
            'feature_image' => $featureImg,
            'address' => $job->address ?: 'Chưa cập nhật địa điểm',
            'job_type' => $job->job_type ?: 'Fulltime',
            'salary' => $salaryDisplay,
            'raw_salary' => $job->salary,
            'predes' => $job->predes ?: '',
            'detail_url' => route('job.show', $job->slug),
            'apply_url' => route('job.show', $job->slug),
            'match_score' => $matchScore,
            'close_date' => $job->application_close_date ? date('d/m/Y', strtotime($job->application_close_date)) : 'Không giới hạn',
        ];
    }
}
