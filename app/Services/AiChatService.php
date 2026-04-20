<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\AiPrompt;


class AiChatService
{
    public function generateMoodAdvice($userText, $moodLabel)
    {
        return $this->askAI('mood_advice', [
            'text' => $userText,
            'mood' => $moodLabel
        ]);
    }

    public function generateLoveAdvice($name1, $name2)
    {
        return $this->askAI('love_percent', [
            'name1' => $name1,
            'name2' => $name2
        ]);
    }

    private function askAI($type, $params = [])
    {

        $promptRecord = AiPrompt::where('prompt_type', $type)
            ->where('is_active', true)
            ->first();

        if (!$promptRecord) {
            return null;
        }

        $template = $promptRecord->content;

        // dd($params);

        foreach ($params as $key => $value) {
            $template = str_replace(":$key", $value, $template);
        }

        $apiKey = env('GEMINI_API_KEY'); //config('GEMINI_API_KEY'); //services.gemini.api_key

        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=" . $apiKey;

        $response = Http::post($url, [
            'contents' => [
                ['parts' => [['text' => $template]]]
            ],
            'generationConfig' => [
                'response_mime_type' => 'application/json',
            ]
        ]);

        //$resultText = data_get($response->json(), 'candidates.0.content.parts.0.text', '{}');

        // if ($response->failed()) {
        //     dd("Lỗi API Gemini:", $response->json());
        // }
        return trim($response->json('candidates.0.content.parts.0.text'));
    }
}
