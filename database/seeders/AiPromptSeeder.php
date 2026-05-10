<?php

namespace Database\Seeders;

use App\Models\AiPrompt;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AiPromptSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AiPrompt::create([
            'prompt_type' => 'system',
            'content' => "Bạn là AI đồng hành MoodToday, hãy đưa lời khuyên ngắn gọn, tử tế và thấu cảm.",
            'version' => '1.0',
            'is_active' => true,
        ]);

        AiPrompt::create([
            'prompt_type' => 'mood_advice',
            'content' => "Bạn là AI của ứng dụng MoodToday. Dựa trên mood ':mood' và tâm sự: ':text', 
                  hãy trả về duy nhất định dạng JSON tiếng Việt: 
                  {
                    'quote': '(câu nói chữa lành)', 
                    'activities': ['hành động 1', 'hành động 2', 'hành động 3'], 
                    'sharing': '(đoạn văn an ủi 3-4 câu)'
                  }",
            'version' => '1.0',
            'is_active' => true,
        ]);

        AiPrompt::create([
            'prompt_type' => 'love_percent',
            'content' => "Bạn là AI Cupid của ứng dụng MoodToday vui tính và am hiểu tâm lý. Hãy bói tình yêu cho ':name1' và ':name2'. 
                  Trả về duy nhất định dạng JSON tiếng Việt: 
                  {
                    'percent': (số từ 0-100), 
                    'message': '(1 câu phán về sự hợp nhau, hài hước hoặc lãng mạn)', 
                    'advice': '(lời khuyên ngắn để duy trì tình cảm)'
                  }",
            'version' => '1.0',
            'is_active' => true,
        ]);

        AiPrompt::create([
            'prompt_type' => 'crush_decoder',
            'content' => "Bạn là AI chuyên gia tâm lý học của ứng dụng MoodToday. Hãy giải mã tin nhắn: ':message'. 
                  Trả về duy nhất định dạng JSON tiếng Việt: 
                  {
                    'hidden_meaning': '(ý nghĩa thật sự đằng sau)', 
                    'reply_hint': '(cách trả lời lại cực cuốn)', 
                    'vibe': '(đánh giá vibe: thả thính, lạnh lùng hay chỉ là bạn bè)'
                  }",
            'version' => '1.0',
            'is_active' => true,
        ]);
    }
}