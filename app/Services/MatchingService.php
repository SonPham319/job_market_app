<?php

namespace App\Services;

use App\Models\Listing;
use App\Models\User;
use App\Services\AIService;

class MatchingService
{
    protected $aiService;

    public function __construct(AIService $aiService)
    {
        $this->aiService = $aiService;
    }

    /**
     * Tính điểm theo rule (cũ)
     */
    public function calculateScore(Listing $listing, User $user)
    {
        $listing->loadMissing('skills');
        $user->loadMissing('skills');

        $totalWeight = 0;
        $matchedWeight = 0;
        $matchedSkills = [];

        // Map skill user
        $userSkillsMap = [];
        foreach ($user->skills as $userSkill) {
            $userSkillsMap[$userSkill->id] = (int) ($userSkill->pivot->level ?? 1);
        }

        foreach ($listing->skills as $jobSkill) {
            $weight = (int) ($jobSkill->pivot->weight ?? 1);
            $totalWeight += $weight;

            if (isset($userSkillsMap[$jobSkill->id])) {
                $level = $userSkillsMap[$jobSkill->id];

                $matchedWeight += $weight * ($level / 5);
                $matchedSkills[] = $jobSkill->name;
            }
        }

        $finalScore = 0;

        if ($totalWeight > 0) {
            $finalScore = round(($matchedWeight / $totalWeight) * 100, 2);
        }

        return [
            'score' => $finalScore,
            'matched_skills' => array_values(array_unique($matchedSkills)),
            'level' => $this->getMatchLevel($finalScore),
        ];
    }

    /**
     * Gọi AI để tính điểm
     */
    public function calculateAIScore($cv, $job)
    {
        try {
            $aiResult = $this->aiService->matchCV($cv, $job);

            $content = $aiResult['choices'][0]['message']['content'] ?? '{}';
            $json = json_decode($content, true);

            return [
                'score' => $json['match_score'] ?? 0,
                'matched_skills' => $json['matched_skills'] ?? [],
                'comment' => $json['comment'] ?? ''
            ];

        } catch (\Exception $e) {
            return [
                'score' => 0,
                'matched_skills' => [],
                'comment' => ''
            ];
        }
    }

    /**
     * Xếp loại
     */
    public function getMatchLevel($score)
    {
        if ($score >= 80) return 'High';
        if ($score >= 50) return 'Medium';
        return 'Low';
    }

    /**
     * Lấy danh sách ứng viên (AI + Rule)
     */
    public function getMatchedCandidates(Listing $listing)
    {
        $listing->loadMissing('skills');

        $employees = User::where('user_type', 'employee')
            ->with('skills')
            ->limit(10) // tránh spam API
            ->get();

        $results = [];

        foreach ($employees as $user) {

            // 🔹 Rule-based
            $ruleMatch = $this->calculateScore($listing, $user);
            $ruleScore = $ruleMatch['score'];

            // 🔹 AI
            $aiMatch = $this->calculateAIScore(
                $user->cv_text ?? '',
                $listing->description ?? ''
            );
            $aiScore = $aiMatch['score'];

            // 🔹 Kết hợp
            $finalScore = ($ruleScore * 0.4) + ($aiScore * 0.6);

            $results[] = [
                'user' => $user,
                'score' => round($finalScore, 2),
                'match_level' => $this->getMatchLevel($finalScore),
                'rule_score' => $ruleScore,
                'ai_score' => $aiScore,
                'matched_skills' => !empty($aiMatch['matched_skills']) 
                    ? $aiMatch['matched_skills'] 
                    : $ruleMatch['matched_skills'],
                'ai_comment' => $aiMatch['comment']
            ];
        }

        usort($results, function ($a, $b) {
            return $b['score'] <=> $a['score'];
        });

        return $results;
    }

    /**
     * Đếm số ứng viên
     */
    public function countMatchedCandidates(Listing $listing)
    {
        $matched = $this->getMatchedCandidates($listing);

        return collect($matched)->where('score', '>', 0)->count();
    }
}