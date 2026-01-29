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
                    'temperature' => 0.2, // Giảm xuống 0.2 để AI trả lời chính xác hơn, ít sáng tạo linh tinh
                    'maxOutputTokens' => 2000, // Tăng lên để không bị cắt cụt JSON
                    'responseMimeType' => 'application/json',
                ],
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

            // Trong Gemini15Service.php
            $text = trim($text);
            // Xóa bỏ các ký tự markdown nếu có
            $text = str_replace(['```json', '```'], '', $text);

            $json = json_decode($text, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                Log::error('Gemini trả về JSON lỗi: ' . json_last_error_msg(), ['text' => $text]);
                // Thử cứu vãn bằng cách đóng ngoặc nếu bị cắt cụt (Optional)
                if (strpos($text, '"data": [') !== false && substr($text, -1) !== '}') {
                    $text .= ' ] }'; 
                    $json = json_decode($text, true);
                }
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
