<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = [
        'name'
    ];

    // public function users()
    // {
    //     return $this->hasMany(User::class);
    // }

    public function teachers()
    {
        return $this->belongsToMany(User::class, 'schools_teachers', 'school_id', 'teacher_id');
    }
}
