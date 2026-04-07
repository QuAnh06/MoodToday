<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'password_hash',
        'role',
    ];

    protected $hidden = [
        'password_hash',
    ];
}