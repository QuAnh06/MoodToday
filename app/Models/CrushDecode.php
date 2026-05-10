<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CrushDecode extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'message_content',
        'hidden_meaning',
        'reply_hint',
        'vibe'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
