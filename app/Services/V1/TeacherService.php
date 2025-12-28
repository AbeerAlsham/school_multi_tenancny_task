<?php

namespace App\Services\V1;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TeacherService
{

    public function createTeacher(array $data)
    {
        $data['type'] = 'teacher';
        $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }

    public function assignTeacherToSchool($teacher, $school)
    {
        return   $teacher->schools()->attach($school->id);
    }

    public function removeTeacherFromSchool($teacher, $school)
    {
        return   $teacher->schools()->detach($school->id);
    }
}
