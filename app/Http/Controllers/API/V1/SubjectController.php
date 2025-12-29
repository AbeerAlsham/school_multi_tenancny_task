<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssignSubjectToTeacherRequest;
use App\Http\Requests\CreateSubjectRequest;
use App\Models\School;
use App\Models\Subject;
use App\Models\User;
use App\Services\V1\SubjectService;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    protected  $subjectService;

    public function __construct(SubjectService $subjectService)
    {
        $this->subjectService = $subjectService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request  $request)
    {
        $subjects = $this->subjectService->getAllSubjects($request);
        return $this->okResponse($subjects);
    }

    /**
     * Display a listing of the resource.
     */
    public function show(Request $request, $subjectId)
    {
        $subject = $this->subjectService->showOne($subjectId);
        if ($subject)
            return $this->okResponse($subject);
        return $this->notFoundResponse("Subject not found");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateSubjectRequest $request)
    {
        $subject = $this->subjectService->createSubject($request->validated());
        return $this->createdResponse($subject, "Subject created successfully");
    }

    // assign subject to school
    public function assignToSchool(Request $request, School $school, $subjectId)
    {
        if ($this->subjectService->assignToSchool($school, $subjectId));
        return $this->okResponse(null, "Subject assigned to school successfully");
    }
    // assign teacher to subject
    public function assignTeacherToSubject(AssignSubjectToTeacherRequest $request, $subjectId,  User $teacher)
    {
        $this->subjectService->assignTeacherToSubject($request->school_id, $subjectId,  $teacher);
        return $this->okResponse(null, "Teacher assigned to subject successfully");
    }
}
