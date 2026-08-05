<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AIService
{
    public function extractSkills($cvText)
    {
        $prompt = "
        Extract all programming, framework, database, and technical skills from this CV.

        Rules:
        - Only return a JSON array
        - No explanation
        - No text outside JSON
        - Skills must be short (e.g: PHP, Laravel, Java, MySQL)

        Example:
        [\"PHP\",\"Laravel\",\"MySQL\",\"Java\"]

        CV:
        $cvText
        ";

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                'Content-Type' => 'application/json',
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-4o-mini',
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => $prompt
                    ]
                ],
                'temperature' => 0.2,
            ]);

            if ($response->failed()) {
                return 'API ERROR: ' . $response->body();
            }

            $result = $response->json();

            $content = $result['choices'][0]['message']['content'] ?? '[]';
            $content = trim($content);

            if (preg_match('/\[(.*?)\]/s', $content, $matches)) {
                return '[' . $matches[1] . ']';
            }

            return '[]';

        } catch (\Exception $e) {
            return 'ERROR: ' . $e->getMessage();
        }
    }

    // =========================
    // 🔥 THÊM HÀM NÀY (KHÔNG ẢNH HƯỞNG CODE CŨ)
    // =========================
    public function matchCV($cvText, $jobDescription)
    {
        $prompt = "
        Compare the candidate CV and the job description.

        Return ONLY JSON format:

        {
            \"match_score\": number (0-100),
            \"matched_skills\": [list of matching skills],
            \"comment\": \"short explanation in Vietnamese\"
        }

        CV:
        $cvText

        JOB:
        $jobDescription
        ";

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                'Content-Type' => 'application/json',
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-4o-mini',
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => $prompt
                    ]
                ],
                'temperature' => 0.3,
            ]);

            if ($response->failed()) {
                return [
                    'choices' => [
                        [
                            'message' => [
                                'content' => json_encode([
                                    'match_score' => 0,
                                    'matched_skills' => [],
                                    'comment' => 'AI lỗi API'
                                ])
                            ]
                        ]
                    ]
                ];
            }

            $result = $response->json();

            $content = $result['choices'][0]['message']['content'] ?? '{}';
            $content = trim($content);

            // 🔥 Lọc JSON nếu AI trả thêm text
            if (preg_match('/\{.*\}/s', $content, $matches)) {
                $content = $matches[0];
            }

            return [
                'choices' => [
                    [
                        'message' => [
                            'content' => $content
                        ]
                    ]
                ]
            ];

        } catch (\Exception $e) {
            return [
                'choices' => [
                    [
                        'message' => [
                            'content' => json_encode([
                                'match_score' => 0,
                                'matched_skills' => [],
                                'comment' => 'Lỗi hệ thống: ' . $e->getMessage()
                            ])
                        ]
                    ]
                ]
            ];
        }
    }
}