<?php

namespace App\Services\V1;

use App\Models\Subject;

class SubjectService
{
    // List subjects (search, pagination, order ASC)
    public function getAllSubjects($request)
    {
        $subjects = Subject::query()
            ->when($request->search, function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            })
            ->orderBy('name', 'asc')
            ->paginate(10);

        return $subjects;
    }
    //show subjct 
    public function showOne($subjectId)
    {
        return Subject::find($subjectId);
    }
    // create subject
    public function createSubject(array $data)
    {
        return Subject::create($data);
    }

    //  Assign Subject to School
    public function assignToSchool($school, $subjectId)
    {
        $subject = Subject::withoutGlobalScopes()->findOrFail($subjectId);
        $school->subjects()->syncWithoutDetaching([$subject->id]);
        return true;
    }

    // Assign Teacher to Subject )
    public function assignTeacherToSubject($schoolId,$subjectId,  $teacher)
    {
        $subject = Subject::findOrFail($subjectId);
        $teacher->subjectsTaught()->attach($subject->id, ['school_id' => $schoolId]);
        
    }
}
