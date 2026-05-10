<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MoodType;
use App\Models\MoodLog;
use App\Models\AiPrompt;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalMoodLogs = MoodLog::count();
        $usersActiveToday = MoodLog::whereDate('created_at', today())->distinct('user_id')->count();
        $usersActive7Days = MoodLog::where('created_at', '>=', now()->subDays(7))->distinct('user_id')->count();

        $today = date('Y-m-d');
        // 2. Mood phổ biến trong ngày
        $popularMoodToday = MoodLog::whereDate('created_at', now('Asia/Ho_Chi_Minh'))
            ->select('mood_id', DB::raw('count(*) as total'))
            ->with('moodType')
            ->groupBy('mood_id')
            ->orderBy('total', 'desc')
            ->first();
        // dd([
        //     'Ngày đang check' => $today,
        //     'Kết quả query' => $popularMoodToday,
        //     'Tổng số log trong DB' => MoodLog::count(), // Xem DB có tí data nào chưa
        // ]);

        $popularMood = $popularMoodToday
            ? MoodType::find($popularMoodToday->mood_id)
            : null;
        // dd($popularMood);
        
        // 3. Dữ liệu biểu đồ mood theo ngày (7 ngày gần nhất)
        $moods = MoodType::where('is_active', true)->get();
        $dates = collect();
        for ($i = 6; $i >= 0; $i--) {
            $dates->push(now()->subDays($i)->format('Y-m-d'));
        }

        $moodChartData = MoodLog::where('created_at', '>=', now()->subDays(7)->startOfDay())
            ->select(DB::raw('DATE(created_at) as date'), 'mood_id', DB::raw('count(*) as count'))
            ->groupBy('date', 'mood_id')
            ->get()
            ->groupBy('date')
            ->map(function ($items) {
                return $items->keyBy('mood_id');
            });
        
//   '2026-04-20' => [
//       1 => {count: 2},
//       2 => {count: 1}
//   ],
//   '2026-04-21' => [
//       1 => {count: 3}
//   ]

        // 4. Giờ hoạt động cao điểm (7 ngày gần nhất)
        $peakHours = MoodLog::select(DB::raw('HOUR(created_at) as hour'), DB::raw('count(*) as count'))
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('hour')
            ->orderBy('count', 'desc')
            ->limit(3)
            ->get();

        return view('admin.dashboard', compact('totalUsers', 'totalMoodLogs', 'usersActiveToday', 'usersActive7Days', 'popularMood', 'moods', 'dates', 'moodChartData', 'peakHours'));
    }

    public function users()
    {
        $users = User::paginate(20);
        return view('admin.users.index', compact('users'));
    }

    //Quan li Mood
    public function moods()
    {
        $moods = MoodType::orderBy('id')->paginate(10);
        return view('admin.moods.index', compact('moods'));
    }

    public function createMood()
    {
        return view('admin.moods.create');
    }

    public function storeMood(Request $request, MoodType $mood)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:mood_types,code,' . $mood->id,
            'label' => 'required|string|max:50|unique:mood_types,label,' . $mood->id,
            'emoji' => 'required|string|max:10',
            'bg_color' => 'nullable|string|max:10,' . $mood->id,
            'ai_tone' => 'nullable|string|max:30',

        ]);

        MoodType::create($validated);

        return redirect()->route('admin.moods.index')->with('success', 'Thêm mood mới thành công!');
    }

    public function editMood(MoodType $mood)
    {
        return view('admin.moods.edit', compact('mood'));
    }

    public function updateMood(Request $request, MoodType $mood)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:mood_types,code,' . $mood->id,
            'label' => 'required|string|max:50|unique:mood_types,label,' . $mood->id,
            'emoji' => 'required|string|max:10',
            'bg_color' => 'nullable|string|max:10,' . $mood->id,
            'ai_tone' => 'nullable|string|max:30',
        ]);

        $mood->update($validated);

        return redirect()->route('admin.moods.index')->with('success', 'Cập nhật mood thành công!');
    }

    public function toggleMood(MoodType $mood)
    {
        $mood->is_active = !$mood->is_active;
        $mood->save();

        $message = $mood->is_active ? 'Bật mood thành công!' : 'Tắt mood thành công!';
        return back()->with('success', $message);
    }


    //Quan li prompt AI
    public function prompts()
    {
        $prompts = AiPrompt::orderBy('id')->paginate(20);
        return view('admin.prompts.index', compact('prompts'));
    }

    public function createPrompt()
    {
        $moods = MoodType::where('is_active', true)->get();
        return view('admin.prompts.create', compact('moods'));
    }

    public function storePrompt(Request $request)
    {
        $validated = $request->validate([
            // 'mood_id' => 'nullable|exists:mood_types,id',
            'prompt_type' => 'required|string|max:100',
            'content' => 'required|string',
            'version' => 'required|numeric|min:1',
        ]);
       
        AiPrompt::create($validated);

        return redirect()->route('admin.prompts.index')->with('success', 'Thêm prompt mới thành công!');
    }

    public function showPrompt(AiPrompt $prompt)
    {
        // $prompt->load('content');
        return view('admin.prompts.show', compact('prompt'));
    }

    public function editPrompt(AiPrompt $prompt)
    {
        $moods = MoodType::where('is_active', true)->get();
        return view('admin.prompts.edit', compact('prompt', 'moods'));
    }

    public function updatePrompt(Request $request, AiPrompt $prompt)
    {
        $validated = $request->validate([
            // 'mood_id' => 'nullable|exists:mood_types,id',
            'prompt_type' => 'required|string|max:100',
            'content' => 'required|string',
            'version' => 'required|numeric|min:1',
        ]);

        $prompt->update($validated);

        return redirect()->route('admin.prompts.index')->with('success', 'Cập nhật prompt thành công!');
    }

    public function destroyPrompt(AiPrompt $prompt)
    {
        $prompt->delete();
        return back()->with('success', 'Xóa prompt thành công!');
    }
}