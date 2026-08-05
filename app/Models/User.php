<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Listing;
use App\Models\Skill;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Các cột được phép thêm / sửa bằng User::create() hoặc update()
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'about',
        'mail',
        'profile_pic',
        'user_type',
        'resume',
        'user_trial',
        'billing_ends',
        'status',
        'plan',
        'email_verified_at', // QUAN TRỌNG: để tự xác minh email khi đăng ký
    ];

    /**
     * Quan hệ: User ứng tuyển nhiều Listing
     */
    public function listings()
    {
    return $this->belongsToMany(Listing::class, 'listing_user', 'user_id', 'listing_id')
        ->withPivot(['shortlisted', 'match_score', 'match_level', 'matched_skills'])
        ->withTimestamps();
    }

    /**
     * Quan hệ: User có nhiều kỹ năng
     */
    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'user_skills', 'user_id', 'skill_id')
            ->withPivot('level')
            ->withTimestamps();
    }

    /**
     * Các thuộc tính ẩn khi trả dữ liệu ra ngoài
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Ép kiểu dữ liệu
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}