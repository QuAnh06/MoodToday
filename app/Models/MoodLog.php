<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MoodLog extends Model
{
    protected $table = 'mood_logs';
    protected $fillable = ['user_id', 'mood_id', 'time_of_day', 'user_text', 'ai_result'];

    public function moodType() {
        return $this->belongsTo(MoodType::class, 'mood_id'); 
    }
}
