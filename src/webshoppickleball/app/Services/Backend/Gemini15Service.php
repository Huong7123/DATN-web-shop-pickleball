<?php

namespace App\Services\Backend;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Log;

class Gemini15Service
{
    private string $model = 'models/gemini-2.5-flash';

    public function ask(string $systemPrompt, string $userMessage): array
    {
        $url = 'https://generativelanguage.googleapis.com/v1beta/'
            . $this->model
            . ':generateContent?key=' . config('gemini.api_key');

        $response = Http::post($url, [
            'contents' => [
                ['role'=>'model','parts'=>[['text'=>$systemPrompt]]],
                ['role'=>'user','parts'=>[['text'=>$userMessage]]]
            ],
            'generationConfig' => [
                'temperature' => 0.3,
                'maxOutputTokens' => 600,
            ]
        ]);

        if (!$response->successful()) {
            Log::error('Gemini RAW Response', $response->json() ?? []);
            return [];
        }

        $text = data_get($response->json(), 'candidates.0.content.parts.0.text');

        if (!$text) return [];

        $text = trim($text);
        $text = preg_replace('/```json|```/', '', $text);

        $json = json_decode($text, true);

        return is_array($json) ? $json : [];
    }

}

