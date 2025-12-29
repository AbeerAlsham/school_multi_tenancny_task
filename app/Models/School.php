<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = [
        'name'
    ];

    public function students(){
        return $this->hasMany(User::class)->where('type', 'student');
    }
    // public function users()
    // {
    //     return $this->hasMany(User::class);
    // }

    public function teachers()
    {
        return $this->belongsToMany(User::class, 'schools_teachers', 'school_id', 'teacher_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'schools_subjects', 'school_id', 'subject_id');
    }
}
