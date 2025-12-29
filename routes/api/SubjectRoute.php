<?php

use App\Http\Controllers\API\V1\SubjectController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum,can:manage-subject'])->group(function () {

    Route::get('subjects', [SubjectController::class, 'index']);

    Route::post('subjects', [SubjectController::class, 'store']);

    Route::get('subjects/{id}', [SubjectController::class, 'show']);

    Route::post('schools/{school}/subjects/{id}/assign-school', [SubjectController::class, 'assignToSchool']);

    Route::post('subjects/{id}/users/{teacher}/assign-teacher', [SubjectController::class, 'assignTeacherToSubject']);

});