<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MoodType;
use App\Models\MoodLog;
use App\Models\AiPrompt;
use App\Services\AiChatService;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class MoodController extends Controller
{
    public function checkinAi()
    {
        // V1: server trả danh sách mood đang bật để user chọn emoji.
        $moods = MoodType::where('is_active', true)->get();

        return view("mood.checkin-ai", compact('moods'));
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $data = $request->validate([
            'mood_id' => 'required|exists:mood_types,id',
            'user_text' => 'required|string|max:5000',
        ]);

        $hour = Carbon::now()->hour;
        $timeOfDay = ($hour >= 5 && $hour < 18) ? 'morning' : 'night';

        $log = MoodLog::create([
            'user_id' => Auth::id(),
            'mood_id' => (int) $data['mood_id'],
            'time_of_day' => $timeOfDay,
            'user_text' => $data['user_text'],
        ]);

        return redirect()->route('mood.loading', ['log_id' => $log->id]);
    }

    public function loading($log_id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $log = MoodLog::findOrFail($log_id);
        if ($log->user_id !== Auth::id()) {
            abort(403);
        }

        return view('mood.loading', compact('log_id'));
    }

    public function result($log_id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $log = MoodLog::with('moodType')
            ->where('user_id', Auth::id())
            ->findOrFail($log_id);

        if (!$log->ai_result) {
            $mood = $log->moodType;

            // Lấy prompt gần nhất theo mood (fallback nếu không có).
            $systemPrompt = AiPrompt::query()
                ->where('mood_id', $mood?->id)
                ->where('prompt_type', 'system')
                ->where('is_active', true)
                ->first()?->content
                ?? AiPrompt::query()
                    ->whereNull('mood_id')
                    ->where('prompt_type', 'system')
                    ->where('is_active', true)
                    ->first()?->content;

            $userPrompt = AiPrompt::query()
                ->where('mood_id', $mood?->id)
                ->where('prompt_type', 'user')
                ->where('is_active', true)
                ->first()?->content
                ?? AiPrompt::query()
                    ->whereNull('mood_id')
                    ->where('prompt_type', 'user')
                    ->where('is_active', true)
                    ->first()?->content;

            $tone = $mood?->ai_tone ?: 'friendly';
            $label = $mood?->label ?: '';
            $emoji = $mood?->emoji ?: '';
            $userText = $log->user_text ?: '';

            $content = null;
            if ($systemPrompt && $userPrompt) {
                $ai = new AiChatService();
                $content = $ai->generateMoodReply(
                    systemPrompt: $systemPrompt,
                    userPrompt: $userPrompt,
                    variables: [
                        'tone' => $tone,
                        'mood_label' => $label,
                        'mood_emoji' => $emoji,
                        'user_text' => $userText,
                        'time_of_day' => $log->time_of_day,
                    ],
                );
            }

            if (!$content) {
                $content = $this->generateFallbackAiContent(
                    tone: $tone,
                    moodLabel: $label,
                    moodEmoji: $emoji,
                    userText: $userText,
                    systemPrompt: $systemPrompt,
                    userPrompt: $userPrompt
                );
            }

            $log->ai_result = $content;
            $log->save();
        }

        return view('mood.result', [
            'log' => $log,
            'content' => $log->ai_result,
        ]);
    }

    public function history()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userId = Auth::id();

        $recentLogs = MoodLog::with('moodType')
            ->where('user_id', $userId)
            ->orderByDesc('created_at')
            ->limit(8)
            ->get();

        // Dữ liệu chart 7 ngày gần nhất: số lần check-in mỗi ngày.
        $labels = [];
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->toDateString();
            $labels[] = Carbon::parse($date)->format('D');
            $data[] = MoodLog::where('user_id', $userId)
                ->whereDate('created_at', $date)
                ->count();
        }

        return view('mood.history', [
            'recentLogs' => $recentLogs,
            'chartLabels' => $labels,
            'chartData' => $data,
        ]);
    }

    public function aiResult(Request $request)
    {
        // Route hiện chưa được sử dụng trong các blade hiện tại.
        // Để tránh lỗi 404/500 nếu bạn gọi từ front-end sau này, giữ endpoint này như fallback.
        $logId = $request->input('log_id');
        if ($logId) {
            return redirect()->route('mood.result', ['log_id' => $logId]);
        }
        return redirect()->route('mood.checkin-ai');
    }

    private function generateFallbackAiContent(
        string $tone,
        string $moodLabel,
        string $moodEmoji,
        string $userText,
        ?string $systemPrompt,
        ?string $userPrompt
    ): string {
        $trimmed = trim($userText);
        if ($trimmed === '') {
            $trimmed = 'Mình không chắc bạn đang cảm thấy gì, nhưng mình ở đây để lắng nghe.';
        }

        // Chuẩn hoá tone để câu chữ bám mục tiêu thân thiện.
        $toneLine = match ($tone) {
            'calm' => 'Bình tĩnh lại một chút nhé.',
            'gentle' => 'Nhẹ nhàng thôi, bạn đang làm tốt hơn bạn nghĩ.',
            'empathetic' => 'Mình hiểu cảm giác đó mà.',
            default => 'Mình nghe bạn rồi.',
        };

        return implode("\n", [
            trim("Mood bạn chọn: {$moodEmoji} {$moodLabel}"),
            $toneLine,
            '',
            "Bạn vừa tâm sự: \"{$trimmed}\"",
            '',
            "Gợi ý cho bạn hôm nay:",
            "- Cho phép bản thân nghỉ ngơi 5-10 phút, thở chậm và đặt tay lên ngực.",
            "- Viết ra 1 việc nhỏ nhất có thể làm ngay bây giờ (rất nhỏ cũng được).",
            "- Nếu có thể, nhắn một tin động viên cho ai đó (hoặc cho chính mình).",
            '',
            "Ghi chú (v1): nội dung này là fallback, chưa gọi AI thật.",
        ]);
    }
}