<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasSchoolScope;

class Subject extends Model
{
    use HasSchoolScope;

    protected $fillable = ['name'];

    public function schools()
    {
        return $this->belongsToMany(School::class,'schools_subjects');
    }


    public function teachers()
    {
        return $this->belongsToMany(User::class, 'subjects_teachers')
            ->withPivot('school_id');
    }
}
