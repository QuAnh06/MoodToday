<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AiChatService;
use App\Models\LoveLog;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class LoveController extends Controller
{
 
    public function lovePercent()
    {
        return view('love-percent.love-percent');
    }
    
    public function store(Request $request) {
        $request->validate([
            'name1' => 'required|string|min:2|max:50',
            'dob1'  => 'required|date|before:today',
            'name2' => 'required|string|min:2|max:50',
            'dob2'  => 'required|date|before:today',
        ], [
            'name1.required' => 'Bạn quên nhập tên của mình rồi kìa!',
            'name1.min'      => 'Tên gì mà ngắn thế, ít nhất 2 ký tự nhé.',
            'dob1.required'  => 'Vui lòng chọn ngày sinh của bạn.',
            'dob1.before'    => 'Ngày sinh không thể là tương lai được đâu.',

            'name2.required' => 'Đừng quên nhập tên người ấy nhé!',
            'name2.min'      => 'Tên người ấy cũng cần ít nhất 2 ký tự nè.',
            'dob2.required'  => 'Người ấy sinh ngày nào bạn nhỉ?',
            'dob2.before'    => 'Ngày sinh người ấy phải ở quá khứ chứ.',
        ]);

        $log = LoveLog::create([
            'user_id' => Auth::id() ?? 1,
            'name1'   => $request->name1,
            'dob1'    => $request->dob1,
            'name2'   => $request->name2,
            'dob2'    => $request->dob2,
        ]);
        return redirect()->route('loading', ['log_id' => $log->id]);
    }

    public function loading($log_id, AiChatService $aiService) {
        $log = LoveLog::findOrFail($log_id);
        
        if (empty($log->ai_result) || $log->ai_result == "null") {
            try{
                $result = $aiService->generateLoveAdvice($log->name1, $log->dob1, $log->name2, $log->dob2);
               
                // if (is_null($result)) {
                //     dd("API trả về NULL.!");
                // }
                
                $log->update(['ai_result' => $result]);
            } catch (\Exception $e) {
                // $log->update(['ai_result' => json_encode([
                //     'percent' => rand(55, 85),
                //     'message' => 'Tình yêu của hai bạn như một bản nhạc nhẹ nhàng, cần thêm thời gian để thăng hoa.',
                //     'advice'  => 'Hệ thống tạm thời không thể trả lời được rồi!'
                // ])]);
                
                // dd("Lỗi Exception: " . $e->getMessage());
            }
        }

        return redirect()->route('result', ['log_id' => $log->id]);
    }

    public function result($log_id) {
        $log = LoveLog::findOrFail($log_id);
        
        $data = json_decode($log->ai_result); 
        // dd($data);
        return view('love-percent.result', compact('log', 'data'));
    }

}
