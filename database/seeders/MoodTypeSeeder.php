<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MoodType;

class MoodTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $moods = [
            [
                'code' => 'happy',
                'emoji' => '😄',
                'label' => 'Vui',
                'is_active' => true,
                'ai_tone' => 'friendly',
                'bg_color' => '#f97316',
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
                'label' => 'Buồn ngủ',
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
            [
                'code' => 'overwhelmed',
                'emoji' => '😫',
                'label' => 'Lo lắng',
                'is_active' => true,
                'ai_tone' => 'grounding',
                'bg_color' => '#475569',
            ],
            [
                'code' => 'angry',
                'emoji' => '😡',
                'label' => 'Tức giận',
                'is_active' => true,
                'ai_tone' => 'calm',
                'bg_color' => '#dc2626',
            ],
            [
                'code' => 'great',
                'emoji' => '😁',
                'label' => 'Tuyệt vời',
                'is_active' => true,
                'ai_tone' => 'positive',
                'bg_color' => '#e98400',
            ],
            [
                'code' => 'love',
                'emoji' => '😍',
                'label' => 'Yêu',
                'is_active' => true,
                'ai_tone' => 'Affectionate',
                'bg_color' => '#db2777',
            ],
        ];

        foreach ($moods as $mood) {
            // Dùng updateOrCreate để nếu chạy lại lệnh seeder, 
            // nó sẽ cập nhật thay vì tạo trùng lặp
            MoodType::updateOrCreate(['code' => $mood['code']], $mood);
        }
    }
}
