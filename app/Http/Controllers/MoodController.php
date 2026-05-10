<?php

namespace App\Http\Controllers;

use App\Models\MoodType;
use App\Models\MoodLog;
use App\Services\AiChatService;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class MoodController extends Controller
{
    
    public function store(Request $request)
    {
        $data = $request->validate([
            'mood_id' => 'required',
            'user_text' => 'required',
        ]);

        $log = MoodLog::create([
            'user_id' => Auth::id() ?? 1, 
            'mood_id' => $data['mood_id'],
            'user_text' => $data['user_text'],
            'time_of_day' => (now()->hour >= 5 && now()->hour < 18) ? 'morning' : 'night',
        ]);

        return redirect()->route('mood.loading', ['log_id' => $log->id]);
    }

    public function result($log_id, AiChatService $aiService)
    {
        
        $log = MoodLog::with('moodType')->findOrFail($log_id); //->where('user_id', Auth::id())

        if (empty($log->ai_result) || $log->ai_result == "null") {
            try {
                $jsonResult = $aiService->generateMoodAdvice($log->user_text, $log->moodType->code);

                // if (!$jsonResult) {
                //     dd("API Gemini chưa trả về dữ liệu. Kiểm tra lại API KEY trong .env");
                // }

                // if (empty($jsonResult)) {
                //     throw new \Exception("API rỗng, fallback");
                // }

                $log->update(['ai_result' => $jsonResult]);

            } catch (\Exception $e) {
                // $log->update(['ai_result' => json_encode([
                //     'quote' => 'Mọi chuyện rồi sẽ ổn thôi.✨',
                //     'activities' => [
                //         'Hít thở sâu trong 3 phút',
                //         'Nghe một bản nhạc không lời nhẹ nhàng',
                //         'Uống một cốc nước ấm'
                //     ],
                //     'sharing' => 'Hệ thống đang bận một chút, nhưng mình vẫn ở đây với bạn.'
                // ])]);
                // dd("Lỗi khi gọi AI: " . $e->getMessage(), "Tại dòng: " . $e->getLine());
            }
        }

        $data = json_decode($log->ai_result);

        // if (is_null($data)) {
        //     dd(
        //         "Lỗi định dạng JSON!",
        //         "Dữ liệu nhận được là:",
        //         $log->ai_result,
        //         "Gợi ý: Có thể AI trả về text thường thay vì JSON?"
        //     );
        // }

        return view('mood.result', compact('log', 'data'));
    }

    public function loading($log_id)
    {
        return view('mood.loading', compact('log_id'));
    }
}