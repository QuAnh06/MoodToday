<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AiPrompt extends Model
{
    protected $fillable = [
        'mood_id',
        'prompt_type',
        'content',
        'version',
        'is_active',
    ];
}
