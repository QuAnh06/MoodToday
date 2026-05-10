<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CrushDecode;
use App\Services\AiChatService;
use Illuminate\Support\Facades\Auth;

class CrushDecoderController extends Controller
{
    public function crushMessage()
    {
        return view('crush-message.crush-message');
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:2000',
        ], [
            'message.required' => 'Dán tin nhắn vào đã chứ bạn ơi!',
        ]);

        $log = CrushDecode::create([
            'user_id'         => Auth::id(),
            'message_content' => $request->message,
        ]);

        return redirect()->route('crush.loading', ['id' => $log->id]);
    }

    public function loading($id, AiChatService $aiService)
    {
        $log = CrushDecode::findOrFail($id);

        if (!$log->hidden_meaning) {
            try {
                $resultRaw = $aiService->decodeCrushMessage($log->message_content);
                
                $data = json_decode($resultRaw, true);
                // dd($resultRaw);
                if (!is_array($data)) throw new \Exception("Dữ liệu hỏng");
            } catch (\Exception $e) {
                $data = []; 
            }

            $log->update([
                'hidden_meaning' => $data['hidden_meaning'] ?? 'Có vẻ người ấy đang muốn giữ bí mật một chút về tâm tư này.',
                'reply_hint'     => $data['reply_hint'] ?? 'Một icon mỉm cười nhẹ nhàng sẽ là câu trả lời an toàn nhất lúc này.',
                'vibe'           => $data['vibe'] ?? 'Bí ẩn',
            ]);
        }

        return redirect()->route('crush.result', ['id' => $log->id]);
    }

    public function result($id)
    {
        $log = CrushDecode::findOrFail($id);

        return view('crush-message.result', compact('log'));
    }
    
}
