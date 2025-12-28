<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSchoolRequest;
use App\Http\Requests\UpdateSchoolRequest;
use App\Models\School;
use Illuminate\Support\Facades\Gate;
use App\Services\V1\SchoolService;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    protected SchoolService $schoolService;

    public function __construct(SchoolService $schoolService)
    {
       
        $this->schoolService = $schoolService;
    }

    public function index(Request $request)
    {
        Gate::authorize('viewAny', School::class);

        $schools = $this->schoolService->getListSchools();

        return $this->okResponse($schools, 'Schools retrieved successfully');
    }

    public function store(StoreSchoolRequest $request)
    {
        Gate::authorize('create', School::class);

        $school = $this->schoolService->createSchool($request->validated());

        return $this->createdResponse(
            $school,
            'School created successfully',
        );
    }

    public function show(School $school)
    {
        Gate::authorize('view', $school);
        return $this->okResponse(
            $this->schoolService->showOne($school),
            'School retrieved successfully'
        );
    }


    public function update(UpdateSchoolRequest $request, School $school)
    {
        Gate::authorize('update', $school);

        $this->schoolService->updateSchool($school, $request->validated());

        return $this->okResponse(
            $school->fresh(),
            'School updated successfully'
        );
    }

    public function destroy(School $school)
    {
        Gate::authorize('delete', $school);

        $this->schoolService->deleteSchool($school);

        return $this->noContentResponse();
    }
}
