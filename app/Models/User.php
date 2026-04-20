<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        // 'zalo_id',
        'id',
        'name',
        'avatar',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        // No password in v1 (auth theo zalo_id), nhưng giữ cấu trúc tương thích nếu có phát sinh.
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    // v1 không dùng email/password, nên không cần casts liên quan.
}
