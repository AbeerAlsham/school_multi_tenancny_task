<?php

namespace App\Services\V1;

use App\Models\School;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentService
{
    public function getAllStudents(School $school)
    {
        return $school->students()->get();
    }

    public function createStudent(array $data)
    {

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $data['type'] = 'student';
        $data['password'] = Hash::make($data['password']);

        //    if user is super admin, they can assign any school_id,
        //  otherwise assign their own school_id
        $data['school_id'] = $user->isSuperAdmin()
            ? ($data['school_id'] ?? null)
            : $user->school_id;

        return User::create($data);
    }
}
