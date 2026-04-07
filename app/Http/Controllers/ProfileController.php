<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MoodLog;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ProfileController extends Controller
{
    
    
    // /**
    //  * Thuật toán tính Mood Streak (Số ngày liên tiếp)
    //  */
    // private function calculateStreak($userId)
    // {
    //     // Lấy danh sách các ngày check-in duy nhất, sắp xếp mới nhất lên đầu
    //     $dates = MoodLog::where('user_id', $userId)
    //         ->selectRaw('DATE(created_at) as date')
    //         ->groupBy('date')
    //         ->orderBy('date', 'desc')
    //         ->pluck('date');

    //     if ($dates->isEmpty()) return 0;

    //     $streak = 0;
    //     $currentDate = Carbon::now();

    //     // Nếu hôm nay chưa check-in, kiểm tra xem hôm qua có check-in không
    //     $firstDate = Carbon::parse($dates[0]);
    //     if (!$firstDate->isToday() && !$firstDate->isYesterday()) {
    //         return 0;
    //     }

    //     foreach ($dates as $index => $date) {
    //         $logDate = Carbon::parse($date);
    //         $diff = Carbon::parse($dates[0])->diffInDays($logDate);

    //         // Nếu ngày hiện tại cách ngày đầu tiên đúng bằng số index -> liên tiếp
    //         if ($diff == $index) {
    //             $streak++;
    //         } else {
    //             break;
    //         }
    //     }

    //     return $streak;
    // }

}