<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MoodType;
use App\Models\MoodLog;
use App\Models\AiPrompt;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalMoods = MoodLog::count();
        $todayMoods = MoodLog::whereDate('created_at', today())->count();
        $activeMoods = MoodType::where('is_active', true)->count();

        return view('admin.dashboard', compact('totalUsers', 'totalMoods', 'todayMoods', 'activeMoods'));
    }

    public function users()
    {
        $users = User::paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function moods()
    {
        $moods = MoodType::paginate(20);
        return view('admin.moods.index', compact('moods'));
    }

    public function prompts()
    {
        $prompts = AiPrompt::with('moodType')->paginate(20);
        return view('admin.prompts.index', compact('prompts'));
    }
}