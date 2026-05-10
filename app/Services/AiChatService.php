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

    public function generateLoveAdvice($name1, $dob1, $name2, $dob2)
    {
        return $this->askAI('love_percent', [
            'name1' => $name1,
            'dob1' => $dob1,
            'name2' => $name2,
            'dob2' => $dob2
        ]);
    }

    public function decodeCrushMessage($message)
    {
        $params = [
            'message' => $message
        ];

        $result = $this->askAI('crush_decoder', $params);

        return $result ?? json_encode([
            'hidden_meaning' => 'AI đang bận yêu rồi, không giải mã được.',
            'reply_hint' => 'Hãy cứ là chính mình nhé!',
            'vibe' => 'Bình thường'
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

        // $url = env("GEMINI_BASE_URL") . '?key=' . env('GEMINI_API_KEY');

        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-3.1-flash-lite-preview:generateContent?key=" . $apiKey;
        //gemini-3.1-flash-lite-preview

        $response = Http::retry(3, 2000) // Thử lại tối đa 3 lần, mỗi lần cách nhau 2 giây
            ->withoutVerifying()->post($url, [
            'contents' => [
                ['parts' => [['text' => $template]]]
            ],
            'generationConfig' => [
                'response_mime_type' => 'application/json',
            ]
        ]);
        // ->throw()

        //$resultText = data_get($response->json(), 'candidates.0.content.parts.0.text', '{}');
        // dd($response->json());

        // if ($response->failed() || empty($response->json())) {
        //     dd([
        //         'STATUS' => $response->status(),
        //         'GOOGLE_SAY' => $response->json(),
        //         'HINT' => 'Nếu thấy 503 là Google đang quá tải, hãy đợi vài giây rồi F5'
        //     ]);
        // }

        return trim($response->json('candidates.0.content.parts.0.text'));
    }
}
