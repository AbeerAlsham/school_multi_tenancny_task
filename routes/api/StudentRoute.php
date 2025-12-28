<?php

use App\Http\Controllers\API\V1\StudentController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum,can:manage-student'])->group(function () {

    Route::post('students', [StudentController::class, 'store']);

    Route::get('schools/{school}/students', [StudentController::class, 'index']);

});
