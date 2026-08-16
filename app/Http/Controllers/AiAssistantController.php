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
     * Hiển thị trang giao diện Trợ Lý AI
     */
    public function index()
    {
        return view('assistant');
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

            if (!$apiKey) {
                return response()->json([
                    'success' => false,
                    'message' => 'Thiếu cấu hình GEMINI_API_KEY trên máy chủ'
                ], 500);
            }

            // System prompt hướng dẫn Gemini NLU phân tích tiêu chí tìm việc
            $systemPrompt = <<<PROMPT
Bạn là Trợ lý AI Tìm Việc Thông Minh (AI Job Assistant) của nền tảng tuyển dụng "JOB SEARCH". Nhiệm vụ của bạn là lắng nghe, trò chuyện thân thiện và hỗ trợ ứng viên tìm kiếm công việc phù hợp nhất từ cơ sở dữ liệu việc làm.

Để gợi ý công việc chính xác nhất, bạn CẦN THU THẬP các thông tin sau từ người dùng:
1. Vị trí công việc hoặc chuyên môn mong muốn (position) - Ví dụ: Lập trình viên Laravel, Frontend ReactJS, Kế toán, Nhân viên Marketing, v.v.
2. Nơi làm việc / Địa điểm mong muốn (location) - Ví dụ: Hà Nội, Hải Phòng, TP.HCM, Đà Nẵng, Toàn quốc, v.v.
3. Mức lương kỳ vọng (salary) tính theo VNĐ/tháng - Ví dụ: 10000000, 15000000, 20000000 (chuyển đổi nếu người dùng nói "10 triệu", "15tr", hoặc để 0 nếu thỏa thuận).
4. Hình thức làm việc (job_type) - Ví dụ: Full-time, Part-time, Remote, Thực tập (tùy chọn nếu người dùng nhắc đến).

Quy trình xử lý:
- Phân tích tin nhắn mới nhất và toàn bộ lịch sử trò chuyện.
- Nếu người dùng CHƯA CUNG CẤP ĐỦ các thông tin cơ bản (ít nhất là vị trí công việc và địa điểm hoặc mức lương):
  + Trả về JSON có status là "pending".
  + Đặt câu hỏi tiếp theo một cách ngắn gọn, ấm áp, tự nhiên bằng tiếng Việt để hỏi phần thông tin còn thiếu.
  + Cung cấp 3-5 lựa chọn nhanh (quick_replies) thật súc tích (dưới 20 ký tự mỗi lựa chọn) để người dùng bấm chọn dễ dàng.
- Nếu người dùng ĐÃ CUNG CẤP ĐỦ hoặc tương đối đầy đủ thông tin tìm việc:
  + Trả về JSON có status là "complete".
  + Trích xuất rõ: position (chuỗi), salary (số nguyên VNĐ hoặc null), location (chuỗi), job_type (chuỗi hoặc null).
  + Tạo lời nhắn tổng kết động viên trong "ai_message" (ví dụ: "Dạ tuyệt vời! Tôi đã ghi nhận mong muốn tìm vị trí [position] tại [location] với mức lương từ [salary]. Dưới đây là những cơ hội việc làm tốt nhất trong hệ thống phù hợp với bạn...").
  + Tạo danh sách từ khóa tìm kiếm tiếng Việt ngắn gọn trong "keywords" (ví dụ: ["laravel", "php", "backend", "mysql"]).
  + Cung cấp 2-3 gợi ý thao tác tiếp theo trong "quick_replies" (ví dụ: ["Xem việc Full-time", "Tìm thêm tại TP.HCM", "Mức lương cao hơn"]).

ĐỊNH DẠNG BẮT BUỘC: Bạn CHỈ ĐƯỢC trả về DUY NHẤT một chuỗi JSON hợp lệ, KHÔNG có markdown hay ký tự bao bọc bên ngoài.

Ví dụ JSON khi CHƯA ĐỦ THÔNG TIN:
{
  "status": "pending",
  "position": "Lập trình viên PHP",
  "location": null,
  "salary": null,
  "job_type": null,
  "ai_message": "Chào bạn! Tôi rất vui được hỗ trợ bạn tìm kiếm công việc Lập trình viên PHP. Bạn mong muốn làm việc tại tỉnh/thành phố nào và có mức lương kỳ vọng ra sao?",
  "quick_replies": ["Hà Nội", "Hải Phòng", "TP. Hồ Chí Minh", "Làm việc từ xa (Remote)"]
}

Ví dụ JSON khi ĐÃ ĐỦ THÔNG TIN:
{
  "status": "complete",
  "position": "Lập trình viên Laravel",
  "location": "Hà Nội",
  "salary": 15000000,
  "job_type": "Full-time",
  "keywords": ["laravel", "php", "backend", "mysql"],
  "ai_message": "Tuyệt vời! Tôi đã tìm kiếm và chọn lọc các vị trí Lập trình viên Laravel tại khu vực Hà Nội với mức thu nhập hấp dẫn phù hợp với bạn bên dưới!",
  "quick_replies": ["Việc lương cao hơn", "Công việc Remote", "Đổi khu vực khác"]
}
PROMPT;

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
                    'temperature' => 0.3
                ]
            ]);

            if (!$response || !$response->successful()) {
                $status = $response ? $response->status() : 500;
                Log::error("Gemini API Error status {$status}: " . ($response ? $response->body() : 'No response'));

                return response()->json([
                    'success' => true,
                    'status' => 'pending',
                    'ai_message' => 'Dạ hệ thống AI đang nhận được nhiều yêu cầu cùng lúc. Bạn có thể cho tôi biết bạn đang tìm vị trí công việc gì, ở khu vực nào và mức lương kỳ vọng nhé!',
                    'quick_replies' => ['Lập trình viên Laravel', 'Frontend ReactJS', 'Nhân viên Kinh doanh', 'Hà Nội', 'Hải Phòng']
                ]);
            }

            $geminiBody = $response->json();
            $geminiText = $geminiBody['candidates'][0]['content']['parts'][0]['text'] ?? '';

            if (empty($geminiText)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không nhận được nội dung phản hồi từ AI'
                ], 500);
            }

            // Parse JSON trả về từ Gemini
            $parsed = json_decode(trim($geminiText), true);
            if (!is_array($parsed)) {
                Log::warning("Gemini Invalid JSON output: " . $geminiText);
                return response()->json([
                    'success' => true,
                    'status' => 'pending',
                    'ai_message' => 'Bạn muốn tìm công việc ở vị trí nào và tại địa điểm nào ạ?',
                    'quick_replies' => ['Lập trình viên', 'Kế toán', 'Hà Nội', 'TP.HCM']
                ]);
            }

            $status = $parsed['status'] ?? 'pending';
            $position = $parsed['position'] ?? null;
            $location = $parsed['location'] ?? null;
            $salary = isset($parsed['salary']) && is_numeric($parsed['salary']) ? (int)$parsed['salary'] : null;
            $jobType = $parsed['job_type'] ?? null;
            $keywords = $parsed['keywords'] ?? [];
            $aiMessage = $parsed['ai_message'] ?? 'Tôi đã tiếp nhận thông tin của bạn.';
            $quickReplies = $parsed['quick_replies'] ?? [];

            // Truy vấn danh sách việc làm từ database
            $allListings = Listing::with(['profile', 'skills'])->latest()->get();

            $matchedJobs = [];
            $alternativeJobs = [];

            if (!empty($position) || !empty($location) || !empty($salary) || !empty($keywords)) {
                $positionTokens = $this->getTokens($position);
                $locationTokens = $this->getTokens($location);
                $keywordTokens = [];
                foreach ($keywords as $kw) {
                    $keywordTokens = array_merge($keywordTokens, $this->getTokens($kw));
                }
                $keywordTokens = array_unique(array_filter($keywordTokens));

                $scoredJobs = [];

                foreach ($allListings as $job) {
                    $score = 0;
                    $jobTitleNorm = $this->normalizeText($job->title);
                    $jobDescNorm = $this->normalizeText($job->description . ' ' . $job->predes . ' ' . $job->roles);
                    $jobAddressNorm = $this->normalizeText($job->address);
                    $jobTypeNorm = $this->normalizeText($job->job_type);

                    // 1. So khớp Tiêu đề & Vị trí (Trọng số lớn: 40đ)
                    $titleMatched = false;
                    foreach ($positionTokens as $token) {
                        if (str_contains($jobTitleNorm, $token)) {
                            $score += 30;
                            $titleMatched = true;
                        } elseif (str_contains($jobDescNorm, $token)) {
                            $score += 15;
                            $titleMatched = true;
                        }
                    }

                    // 2. So khớp Từ khóa kỹ năng (Trọng số: 25đ)
                    foreach ($keywordTokens as $kwToken) {
                        if (str_contains($jobTitleNorm, $kwToken)) {
                            $score += 15;
                        } elseif (str_contains($jobDescNorm, $kwToken)) {
                            $score += 8;
                        }
                    }

                    // 3. So khớp Địa điểm (Trọng số: 25đ)
                    if (!empty($locationTokens)) {
                        $locMatch = false;
                        foreach ($locationTokens as $locToken) {
                            if (str_contains($jobAddressNorm, $locToken)) {
                                $score += 25;
                                $locMatch = true;
                                break;
                            }
                        }
                    } else {
                        $score += 10; // Không yêu cầu địa điểm cụ thể
                    }

                    // 4. So khớp Mức lương (Trọng số: 15đ)
                    $jobSalaryNum = is_numeric($job->salary) ? (int)$job->salary : 0;
                    if ($salary && $salary > 0) {
                        if ($jobSalaryNum >= $salary) {
                            $score += 15;
                        } elseif ($jobSalaryNum >= ($salary * 0.7)) {
                            $score += 8;
                        } elseif ($jobSalaryNum == 0) { // Thỏa thuận
                            $score += 5;
                        }
                    } else {
                        $score += 10;
                    }

                    // 5. So khớp Hình thức làm việc (Trọng số: 10đ)
                    if ($jobType) {
                        $jobTypeInputNorm = $this->normalizeText($jobType);
                        if (str_contains($jobTypeNorm, $jobTypeInputNorm) || str_contains($jobTypeInputNorm, $jobTypeNorm)) {
                            $score += 10;
                        }
                    }

                    if ($score > 15) {
                        $scoredJobs[] = [
                            'job' => $job,
                            'score' => min(100, $score),
                        ];
                    }
                }

                // Sắp xếp theo điểm số giảm dần
                usort($scoredJobs, function ($a, $b) {
                    return $b['score'] <=> $a['score'];
                });

                // Tách thành danh sách chính và thay thế
                $topScored = array_slice($scoredJobs, 0, 4);
                $altScored = array_slice($scoredJobs, 4, 4);

                $matchedJobs = array_map(function ($item) {
                    return $this->formatJobData($item['job'], $item['score']);
                }, $topScored);

                $alternativeJobs = array_map(function ($item) {
                    return $this->formatJobData($item['job'], $item['score']);
                }, $altScored);
            }

            // Nếu không có job nào khớp sâu, lấy một số job nổi bật làm gợi ý thay thế
            if (empty($matchedJobs) && empty($alternativeJobs)) {
                $featured = $allListings->take(4);
                $alternativeJobs = $featured->map(function ($job) {
                    return $this->formatJobData($job, 75);
                })->toArray();
            }

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
     * Định dạng dữ liệu job trả về cho giao diện Frontend
     */
    private function formatJobData($job, $matchScore = 85)
    {
        $companyName = $job->profile ? ($job->profile->name ?? 'Nhà tuyển dụng') : 'Doanh nghiệp';
        $companyAvatar = $job->profile && $job->profile->profile_pic 
            ? asset('storage/' . $job->profile->profile_pic)
            : asset('image/logo-jobsearch.png');

        $featureImg = $job->feature_image 
            ? asset('storage/' . $job->feature_image)
            : null;

        $salaryDisplay = 'Thỏa thuận';
        if (is_numeric($job->salary) && (int)$job->salary > 0) {
            $val = (int)$job->salary;
            if ($val >= 1000000) {
                $salaryDisplay = number_format($val / 1000000, 1) . ' Triệu';
                $salaryDisplay = str_replace('.0 Triệu', ' Triệu', $salaryDisplay);
            } else {
                $salaryDisplay = number_format($val) . ' VNĐ';
            }
        } elseif (!empty($job->salary) && !is_numeric($job->salary)) {
            $salaryDisplay = $job->salary;
        }

        return [
            'id' => $job->id,
            'title' => $job->title,
            'slug' => $job->slug,
            'company_name' => $companyName,
            'company_avatar' => $companyAvatar,
            'feature_image' => $featureImg,
            'address' => $job->address ?? 'Toàn quốc',
            'job_type' => $job->job_type ?? 'Full-time',
            'salary' => $salaryDisplay,
            'raw_salary' => $job->salary,
            'predes' => $job->predes ?? '',
            'detail_url' => route('job.show', $job->slug),
            'apply_url' => route('job.show', $job->slug),
            'match_score' => $matchScore,
            'close_date' => $job->application_close_date ? date('d/m/Y', strtotime($job->application_close_date)) : 'Đang tuyển',
        ];
    }
}
