<?php

namespace App\Http\Controllers;

use App\Mail\JobPosted;
use App\Models\Jobs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class JobsController extends Controller
{
    public function index()
    {
        // pagination enabled and sorting by latest uploaded
        $jobs = Jobs::with('employer')->latest()->cursorPaginate(10); 
        
        return view('jobs.index', ['jobs' => $jobs]);
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function show(Jobs $job)
    {
        return view('jobs.show', ['job' => $job]);
    }

    public function store()
    {
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]);
    
        $job = Jobs::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1
        ]);

        // Send confirmation email
        // send automatically to the user
        Mail::to($job->employer->user)->queue(
            new JobPosted($job)
        );
    
        return redirect('/jobs');

    }

    public function edit(Jobs $job)
    {  
        return view('jobs.edit', ['job' => $job]);
    }

    public function update(Jobs $job)
    {
        //authorize (on hold)
        Gate::authorize('edit-job', $job);

        //validate
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]);

        // 1st method to update
        // $job->title = request('title');
        // $job->salary = request('salary');
        // $job->save();
        
        // 2nd method to update
        $job->update([
            'title' => request('title'),
            'salary' => request('salary')
        ]);

        //redirect to the job page
        return redirect('/jobs/'.$job->id);
    }

    public function destroy(Jobs $job)
    {
        //authorize
        Gate::authorize('edit-job', $job);

        //delete the job
        $job->delete();

        //redirect
        return redirect('/jobs');
    }
}
