<?php

use App\Http\Controllers\JobsController;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home');

// Routes for job
Route::get('/jobs', [JobsController::class, 'index']);
Route::get('/jobs/create', [JobsController::class, 'create']);
Route::get('/jobs/{job}', [JobsController::class, 'show']);
Route::post('/jobs', [JobsController::class, 'store']);
Route::get('/jobs/{job}/edit', [JobsController::class, 'edit']);
Route::patch('/jobs/{job}', [JobsController::class, 'update']);
Route::delete('/jobs/{job}', [JobsController::class, 'destroy']);

Route::view('/about', 'about');
Route::view('/contact', 'contact');
