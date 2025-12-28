<?php

use App\Http\Controllers\API\V1\TeacherController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum','can:manage-teacher'])->group(function () {

    Route::post('teachers', [TeacherController::class, 'store']);

    Route::post('schools/{school}/teachers/{teacher}/assign', [TeacherController::class, 'assignTeacherToSchool']);

    Route::delete('schools/{school}/teachers/{teacher}/remove', [TeacherController::class, 'removeTeacherFromSchool']);
});
