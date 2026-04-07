<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\MoodType;
use App\Models\AiPrompt;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed mood_types/ai_prompts để check-in hiển thị emoji.
        if (MoodType::count() === 0) {
            $moods = [
                [
                    'code' => 'happy',
                    'emoji' => '😄',
                    'label' => 'Vui',
                    'is_active' => true,
                    'ai_tone' => 'friendly',
                    'bg_color' => '#2D5BFF',
                ],
                [
                    'code' => 'neutral',
                    'emoji' => '😐',
                    'label' => 'Bình thường',
                    'is_active' => true,
                    'ai_tone' => 'calm',
                    'bg_color' => '#6B7280',
                ],
                [
                    'code' => 'tired',
                    'emoji' => '😴',
                    'label' => 'Mệt',
                    'is_active' => true,
                    'ai_tone' => 'gentle',
                    'bg_color' => '#374151',
                ],
                [
                    'code' => 'sad',
                    'emoji' => '😔',
                    'label' => 'Buồn',
                    'is_active' => true,
                    'ai_tone' => 'empathetic',
                    'bg_color' => '#2563EB',
                ],
            ];

            foreach ($moods as $mood) {
                MoodType::updateOrCreate(['code' => $mood['code']], $mood);
            }
        }

        if (AiPrompt::count() === 0) {
            AiPrompt::create([
                'mood_id' => null,
                'prompt_type' => 'system',
                'content' => 'Bạn là AI đồng hành MoodToday, hãy đưa lời khuyên ngắn gọn và tử tế.',
                'version' => '1.0',
                'is_active' => true,
            ]);
            AiPrompt::create([
                'mood_id' => null,
                'prompt_type' => 'user',
                'content' => 'Người dùng tâm sự: {user_text}. Hãy trả lời theo mood phù hợp và đưa 3 gợi ý nhỏ.',
                'version' => '1.0',
                'is_active' => true,
            ]);

            foreach (['happy', 'neutral', 'tired', 'sad'] as $code) {
                $mood = MoodType::where('code', $code)->first();
                if (!$mood) {
                    continue;
                }

                $system = "Bạn là AI đồng hành MoodToday. Mood hiện tại: {$mood->label}. Giọng điệu phù hợp: {$mood->ai_tone}.";
                $user = "Người dùng đã chọn mood {$mood->emoji} ({$mood->label}) và tâm sự: {user_text}. Trả lời: 1 câu thấu hiểu + 3 gợi ý nhỏ.";

                AiPrompt::create([
                    'mood_id' => $mood->id,
                    'prompt_type' => 'system',
                    'content' => $system,
                    'version' => '1.0',
                    'is_active' => true,
                ]);
                AiPrompt::create([
                    'mood_id' => $mood->id,
                    'prompt_type' => 'user',
                    'content' => $user,
                    'version' => '1.0',
                    'is_active' => true,
                ]);
            }
        }

        // User mẫu để test nhanh: zalo_id = "test"
        if (User::count() === 0) {
            User::create([
                'zalo_id' => 'test',
                'name' => 'Test User',
                'avatar' => null,
                'status' => 'active',
            ]);
        }
    }
}
