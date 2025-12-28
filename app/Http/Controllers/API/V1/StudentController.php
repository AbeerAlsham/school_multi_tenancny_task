<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateStudentRequest;
use App\Models\School;
use App\Services\V1\StudentService;

class StudentController extends Controller
{
    protected $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    public function index(School $school)
    {
        return $this->okResponse(
            $this->studentService->getAllStudents($school),
            'Students retrieved successfully'
        );
    }
    public function Store(CreateStudentRequest $request)
    {
        $student = $this->studentService->createStudent($request->all());

        return $this->createdResponse(
            $student,
            'Student created successfully',
        );
    }
}
