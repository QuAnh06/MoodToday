<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AiChatService
{
    /**
     * Gọi OpenAI và trả về text output.
     * - Giữ prompt pipeline: system + user.
     * - Trả về null nếu không call được.
     */
    public function generateMoodReply(
        string $systemPrompt,
        string $userPrompt,
        array $variables = []
    ): ?string {
        $apiKey = config('services.openai.api_key');
        if (!$apiKey) {
            return null;
        }

        $model = (string) config('services.openai.model', 'gpt-4.1-mini');
        $baseUrl = rtrim((string) config('services.openai.base_url', 'https://api.openai.com/v1'), '/');
        $timeout = (int) config('services.openai.timeout', 30);

        $system = $this->interpolate($systemPrompt, $variables);
        $user = $this->interpolate($userPrompt, $variables);

        try {
            $res = Http::timeout($timeout)
                ->withToken($apiKey)
                ->acceptJson()
                ->asJson()
                ->post($baseUrl . '/responses', [
                    'model' => $model,
                    'input' => [
                        [
                            'role' => 'system',
                            'content' => [
                                ['type' => 'input_text', 'text' => $system],
                            ],
                        ],
                        [
                            'role' => 'user',
                            'content' => [
                                ['type' => 'input_text', 'text' => $user],
                            ],
                        ],
                    ],
                    // Giữ output ngắn gọn và đúng format text
                    'text' => [
                        'format' => ['type' => 'text'],
                    ],
                ]);

            if (!$res->successful()) {
                return null;
            }

            $data = $res->json();

            // Responses API thường có output_text
            if (is_array($data) && isset($data['output_text']) && is_string($data['output_text'])) {
                $out = trim($data['output_text']);
                return $out !== '' ? $out : null;
            }

            // Fallback: gom từ output[].content[].text
            $out = $this->extractTextFromResponsesPayload($data);
            $out = trim((string) $out);
            return $out !== '' ? $out : null;
        } catch (\Throwable $e) {
            return null;
        }
    }

    private function interpolate(string $template, array $variables): string
    {
        // Hỗ trợ placeholder {user_text}, {mood_label}, ...
        $out = $template;
        foreach ($variables as $key => $value) {
            $placeholder = '{' . $key . '}';
            $out = str_replace($placeholder, (string) $value, $out);
        }
        return $out;
    }

    private function extractTextFromResponsesPayload(mixed $data): ?string
    {
        if (!is_array($data)) {
            return null;
        }
        $output = $data['output'] ?? null;
        if (!is_array($output)) {
            return null;
        }

        $chunks = [];
        foreach ($output as $item) {
            if (!is_array($item)) {
                continue;
            }
            $content = $item['content'] ?? null;
            if (!is_array($content)) {
                continue;
            }
            foreach ($content as $c) {
                if (!is_array($c)) {
                    continue;
                }
                $text = $c['text'] ?? null;
                if (is_string($text) && $text !== '') {
                    $chunks[] = $text;
                }
            }
        }

        $joined = trim(implode("\n", $chunks));
        return $joined !== '' ? $joined : null;
    }
}

