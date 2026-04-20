<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LoveLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name1',
        'dob1',
        'name2',
        'dob2',
        'ai_result',
    ];

    // protected $casts = [
    //     'dob1' => 'date', 
    //     'dob2' => 'date',
    // ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
