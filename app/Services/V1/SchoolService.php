<?php

namespace App\Services\V1;

use App\Models\School;

class SchoolService
{

    public function getListSchools()
    {
      return  School::query()
            ->orderBy('id', 'desc')
            ->paginate(10);
    }


    public function showOne(School $school)
    {
        return $school;
    }

    public function createSchool(array $data)
    {
        return School::create($data);
    }

    public function updateSchool(School $school, array $data)
    {
        $school->update($data);
        return $school;
    }

    public function deleteSchool(School $school)
    {
        return $school->delete();
    }
}
