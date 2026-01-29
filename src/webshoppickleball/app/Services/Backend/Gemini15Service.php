<?php

namespace App\Services\Backend;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Gemini15Service
{
    private string $model = 'models/gemini-2.5-flash';

    public function ask(string $systemPrompt, string $userMessage): array
    {
        $url = 'https://generativelanguage.googleapis.com/v1beta/'
            . $this->model
            . ':generateContent?key=' . env('GEMINI_API_KEY');

        try {
            /** @var \Illuminate\Http\Client\Response $response */
            $response = Http::timeout(15)->post($url, [
                'contents' => [
                    [
                        'role' => 'model',
                        'parts' => [['text' => $systemPrompt]]
                    ],
                    [
                        'role' => 'user',
                        'parts' => [['text' => $userMessage]]
                    ]
                ],
                'generationConfig' => [
                    'temperature' => 0.3,
                    'maxOutputTokens' => 500,
                ]
            ]);

            // ❌ Gemini lỗi (429, 5xx, quota...)
            if (!$response->successful()) {
                Log::error('Gemini error', [
                    'status' => $response->status(),
                    'body'   => $response->json(),
                ]);

                // 🔥 BẮT BUỘC throw
                throw new \RuntimeException(
                    'Gemini API error: ' . $response->status(),
                    $response->status()
                );
            }

            $text = data_get($response->json(), 'candidates.0.content.parts.0.text');

            // Gemini OK nhưng không trả nội dung
            if (!$text) {
                return [
                    'message' => '',
                    'data' => []
                ];
            }

            $text = trim($text);
            $text = preg_replace('/```json|```/', '', $text);

            $json = json_decode($text, true);

            // Gemini trả không đúng JSON
            if (!is_array($json)) {
                Log::warning('Gemini response is not valid JSON', [
                    'raw_text' => $text
                ]);

                return [
                    'message' => '',
                    'data' => []
                ];
            }

            return $json;

        } catch (\Throwable $e) {
            // ⚠️ CHỈ log – KHÔNG nuốt lỗi
            Log::error('Gemini exception', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ]);

            // 🔥 ĐẨY LỖI LÊN consult()
            throw $e;
        }
    }
}
