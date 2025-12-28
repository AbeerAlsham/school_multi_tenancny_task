<?php

use App\Http\Controllers\API\V1\SchoolController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('schools', SchoolController::class);
});