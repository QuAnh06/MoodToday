<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MoodType extends Model
{
    protected $fillable = [
        'code',
        'emoji',
        'label',
        'is_active',
        'ai_tone',
        'bg_color',
    ];

    public function prompts() {
        return $this->hasMany(AiPrompt::class, 'mood_id');
    }
}
