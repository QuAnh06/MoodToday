<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\MoodLog;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(){
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userId = Auth::id();

        $checkinToday = MoodLog::where('user_id', $userId)
            ->whereDate('created_at', Carbon::now()->toDateString())
            ->exists();

        $labels = [];
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->toDateString();
            $labels[] = Carbon::parse($date)->format('D');
            $data[] = MoodLog::where('user_id', $userId)
                ->whereDate('created_at', $date)
                ->count();
        }

        return view('mood.home', [
            'userName' => Auth::user()->name,
            'checkinToday' => $checkinToday,
            'chartLabels' => $labels,
            'chartData' => $data,
        ]);
    }
    public function splash(){
        return view('mood.splash');
    }
    
    public function history(){
        return view('mood.history');
    }

    public function show()
    {
        return view('profile');
    }
    public function settings()
    {
        return view('settings');
    }

    public function notis()
    {
        return view('mood.notifications');
    }
    
}
