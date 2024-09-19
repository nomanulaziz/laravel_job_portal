<?php

use App\Http\Controllers\JobsController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SessionController;
use App\Jobs\TranslateJob;
use App\Mail\JobPosted;
use App\Models\Jobs;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home');
Route::view('/about', 'about');
Route::view('/contact', 'contact');

//test route

Route::get('test', function () {

    //fetching the first record from the jobs_listing
    //table and passing to the dispatch
    $job = Jobs::first();

    //dispatching specific job
    TranslateJob::dispatch($job);

    return 'Done';
});

// Routes for job
Route::get('/jobs', [JobsController::class, 'index']); //show all jobs
Route::get('/jobs/create', [JobsController::class, 'create']); //create new job view
Route::post('/jobs', [JobsController::class, 'store']); //store the created job
Route::get('/jobs/{job}', [JobsController::class, 'show']); //show a singe job

//added middleware that if user is logged-in and can edit that specific job
//job in can:edit-job,job refers to the 2nd parameter in the url {job}
Route::get('/jobs/{job}/edit', [JobsController::class, 'edit'])
    ->middleware('auth')
    ->can('edit', 'job'); // edit single job view

Route::patch('/jobs/{job}', [JobsController::class, 'update']); // update the job
Route::delete('/jobs/{job}', [JobsController::class, 'destroy']); // delete the job

// Auth
Route::get('/register', [RegisterUserController::class, 'create']);
Route::post('/register', [RegisterUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);

Route::post('/logout', [SessionController::class, 'destroy']);
