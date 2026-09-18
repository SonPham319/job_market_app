<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Skill;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'job_title',
        'title',
        'predes',
        'description',
        'roles',
        'job_type',
        'address',
        'salary',
        'application_close_date',
        'feature_image',
        'slug'
    ];

    public function getTitleAttribute()
    {
        return $this->attributes['job_title'] ?? ($this->attributes['title'] ?? null);
    }


    public function users()
    {
       return $this->belongsToMany(User::class, 'listing_user', 'listing_id', 'user_id')
        ->withPivot(['shortlisted', 'match_score', 'match_level', 'matched_skills'])
        ->withTimestamps();
    }

    public function profile()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'listing_skills', 'listing_id', 'skill_id')
            ->withPivot('weight')
            ->withTimestamps();
    }
}