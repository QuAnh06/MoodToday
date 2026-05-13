<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\MoodLog;
use App\Models\MoodType;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    
    public function splash(){
        return view('mood.splash');
    }

    public function index(Request $request)
    {
        $userName = Auth::check() ? Auth::user()->name : 'bạn';
        $userId = Auth::id() ?? 1;
        
        $moodTypes = MoodType::where('is_active', true)->orderBy('id')->get();

        $timeframe = $request->query('timeframe', '7days'); 

        $startDate = match ($timeframe) {
            '1month' => now()->subMonth(),
            '3months' => now()->subMonths(3),
            '6months' => now()->subMonths(6),
            default => now()->subDays(7),
        };

        $moodCounts = MoodLog::where('user_id', $userId)
            ->where('created_at', '>=', $startDate)
            ->selectRaw('mood_id, count(*) as total')
            ->groupBy('mood_id')
            ->pluck('total', 'mood_id');

        $maxCount = $moodCounts->max() ?: 1;

        // Mood Chart
        $chartData = $moodTypes->map(function ($type) use ($moodCounts, $maxCount) {
            $count = $moodCounts[$type->id] ?? 0;
            $barHeight = ($count / $maxCount) * 100;

            return [
                'emoji'     => $type->emoji,
                'name'      => $type->name,
                'count'     => $count,
                'barHeight' => $barHeight,
                'color'     => $count > ($maxCount * 0.5) ? '#10b981' : '#f43f5e'
            ];
        });

        $recentLogs = collect();
        $logCount = 0;

        if (Auth::check() || true) {
            $logCount = MoodLog::where('user_id', $userId)->count();
            $recentLogs = MoodLog::with('moodType')
                ->where('user_id', $userId)
                ->latest()
                ->take(3)
                ->get();
        }

        $startOfWeek = Carbon::now()->startOfWeek(Carbon::MONDAY);
        $weekDays = [];
        for ($i = 0; $i < 7; $i++) {
            $day = $startOfWeek->copy()->addDays($i);
            $weekDays[] = [
                'label'   => $day->format('D'), 
                'date'    => $day->format('d'), 
                'isToday' => $day->isToday(),   
            ];
        }

        $hasMoreLogs = $logCount > 3;

        if ($request->ajax()) {
            return view('mood._chart', compact('chartData'))->render();
        }

        return view('mood.home', compact(
            'userName', 
            'recentLogs', 
            'moodTypes', 
            'weekDays',
            'hasMoreLogs',
            'chartData',
            'timeframe'
        ));
    }
    
    public function history(){
        // if (!Auth::check()) return redirect()->route('login');

        $userId = Auth::id() ?? 1;

        $logs = MoodLog::with('moodType')
            ->where('user_id', $userId)
            ->latest()
            ->get()
            ->groupBy(function($item) {
                return $item->created_at->format('d F Y');
            });

        $totalLogs = $logs->flatten()->count();

        return view('mood.diary', compact('logs', 'totalLogs'));
    }

    public function show()
    {
        return view('profile');
    }

}
