<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTeacherRequest;
use App\Models\School;
use App\Models\User;
use App\Services\V1\TeacherService;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    protected  $teacherService;

    public function __construct(TeacherService $teacherService)
    {
        $this->teacherService = $teacherService;
    }

    public function Store(CreateTeacherRequest $request)
    {
        $teacher = $this->teacherService->createTeacher($request->all());

        return $this->createdResponse(
            $teacher,
            'Teacher created successfully',
        );
    }

    public function assignTeacherToSchool(Request $request, School $school, User $teacher)
    {
        $this->teacherService->assignTeacherToSchool($teacher, $school);

        return $this->okResponse(
            null,
            'Teacher assigned to school successfully'
        );
    }

    public function removeTeacherFromSchool(Request $request,  School $school, User $teacher)
    {
        $this->teacherService->removeTeacherFromSchool($teacher, $school);

        return $this->noContentResponse();
    }
}
