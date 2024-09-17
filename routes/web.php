<?php

use App\Http\Controllers\JobsController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SessionController;
use Barryvdh\Debugbar\DataCollector\JobsCollector;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home');
Route::view('/about', 'about');
Route::view('/contact', 'contact');

// Routes for job
Route::resource('jobs', JobsController::class);
// Auth
Route::get('/register', [RegisterUserController::class, 'create']);
Route::post('/register', [RegisterUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);

Route::post('/logout', [SessionController::class, 'destroy']);


// Routes for job
// Route::controller(JobsController::class)->group(function () {
//     Route::get('/jobs', 'index');
//     Route::get('/jobs/create', 'create');
//     Route::get('/jobs/{job}', 'show');
//     Route::post('/jobs', 'store');
//     Route::get('/jobs/{job}/edit', 'edit');
//     Route::patch('/jobs/{job}', 'update');
//     Route::delete('/jobs/{job}', 'destroy');
// });

