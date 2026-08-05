<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function listings()
    {
        return $this->belongsToMany(Listing::class, 'listing_skills')
                    ->withPivot('weight')
                    ->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_skills')
                    ->withPivot('level')
                    ->withTimestamps();
    }
}