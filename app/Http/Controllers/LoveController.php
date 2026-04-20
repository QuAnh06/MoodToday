<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AiChatService;
use App\Models\LoveLog;

class LoveController extends Controller
{
 
    public function lovePercent()
    {
        return view('love-percent.love-percent');
    }
    
    public function store(Request $request) {
        $log = LoveLog::create([
            'user_id' => auth()->id(),
            'name1'   => $request->name1,
            'dob1'    => $request->dob1,
            'name2'   => $request->name2,
            'dob2'    => $request->dob2,
        ]);
        return redirect()->route('loading', ['log_id' => $log->id]);
    }

    public function loading($log_id, AiChatService $aiService) {
        $log = LoveLog::findOrFail($log_id);
        
        if (!$log->ai_result) {
            
            $result = $aiService->generateLoveAdvice($log->name1, $log->name2);

            $log->update(['ai_result' => $result]);
        }
        return redirect()->route('result', ['log_id' => $log->id]);
    }

    public function result($log_id) {
        $log = LoveLog::findOrFail($log_id);
 
        $data = json_decode($log->ai_result); 
        return view('love-percent.result', compact('log', 'data'));
    }

    public function crushMessage()
    {
        return view('crush-message.crush-message');
    }
}
