<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\AIService;

class MatchingController extends Controller
{
    protected $aiService;

    public function __construct(AIService $aiService)
    {
        $this->aiService = $aiService;
    }

    /**
     * Hiển thị danh sách ứng viên phù hợp với 1 công việc
     */
    public function showMatchedCandidates($id)
    {
        $listing = Listing::with('skills')->findOrFail($id);

        $matchedCandidates = $this->getMatchedCandidates($listing);

        return view('matching.candidates', compact('listing', 'matchedCandidates'));
    }

    /**
     * Hàm lấy danh sách ứng viên phù hợp (AI + Rule)
     */
    public function getMatchedCandidates($listing)
    {
        $jobSkills = $listing->skills;

        $employees = User::where('user_type', 'employee')
            ->with('skills')
            ->limit(10) // tránh gọi AI quá nhiều
            ->get();

        $matchedCandidates = [];

        foreach ($employees as $employee) {

            // =========================
            // 🔹 1. TÍNH ĐIỂM CŨ (RULE)
            // =========================
            $score = 0;
            $totalWeight = 0;
            $matchedSkills = [];

            foreach ($jobSkills as $jobSkill) {
                $weight = (int) $jobSkill->pivot->weight;
                $totalWeight += $weight;

                foreach ($employee->skills as $userSkill) {
                    if ($jobSkill->id == $userSkill->id) {
                        $level = (int) $userSkill->pivot->level;

                        $score += $weight * $level;
                        $matchedSkills[] = $jobSkill->name;
                    }
                }
            }

            $ruleScore = 0;
            if ($totalWeight > 0) {
                $ruleScore = round(($score / ($totalWeight * 5)) * 100, 2);
            }

            // =========================
            // 🔹 2. AI MATCHING
            // =========================
            $aiScore = 0;
            $aiMatchedSkills = [];
            $aiComment = '';

            try {
                $aiResult = $this->aiService->matchCV(
                    $employee->cv_text ?? '',
                    $listing->description ?? ''
                );

                $content = $aiResult['choices'][0]['message']['content'] ?? '{}';
                $json = json_decode($content, true);

                $aiScore = $json['match_score'] ?? 0;
                $aiMatchedSkills = $json['matched_skills'] ?? [];
                $aiComment = $json['comment'] ?? '';

            } catch (\Exception $e) {
                // Nếu AI lỗi thì bỏ qua, dùng score cũ
                $aiScore = 0;
            }

            // =========================
            // 🔹 3. KẾT HỢP
            // =========================
            $finalScore = ($ruleScore * 0.4) + ($aiScore * 0.6);

            $matchedCandidates[] = [
                'user' => $employee,
                'score' => round($finalScore, 2),
                'rule_score' => $ruleScore,
                'ai_score' => $aiScore,
                'matched_skills' => !empty($aiMatchedSkills) ? $aiMatchedSkills : $matchedSkills,
                'ai_comment' => $aiComment,
            ];
        }

        // Sắp xếp giảm dần
        usort($matchedCandidates, function ($a, $b) {
            return $b['score'] <=> $a['score'];
        });

        return $matchedCandidates;
    }

    /**
     * Đếm số ứng viên có điểm > 0
     */
    public function countMatchedCandidates($listing)
    {
        $matchedCandidates = $this->getMatchedCandidates($listing);

        return collect($matchedCandidates)->where('score', '>', 0)->count();
    }
}