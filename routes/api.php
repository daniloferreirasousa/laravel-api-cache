<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CourseController;


Route::put('/course/{course}', [CourseController::class, 'update']);
Route::delete('/course/{identify}', [CourseController::class, 'destroy']);
Route::get('/course/{identify}', [CourseController::class, 'show']);

Route::post('/courses', [CourseController::class, 'store']);
Route::get('/courses', [CourseController::class, 'index']);


Route::get('/', function () {
    return response()->json(['message' => 'Ok']);
});
