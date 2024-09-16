<?php

namespace App\Http\Controllers;

use App\Models\Jobs;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    public function index()
    {
        // pagination enabled and sorting by latest uploaded
        $jobs = Jobs::with('employer')->latest()->cursorPaginate(10); 
        
        return view('jobs.index', ['jobs' => $jobs]);
    }

    public function create($job)
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
    
        Jobs::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1
        ]);
    
        return redirect('/jobs');
    }

    public function edit(Jobs $job)
    {
        return view('jobs.edit', ['job' => $job]);
    }

    public function update(Jobs $job)
    {
        //authorize (on hold)

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

    public function destroy(JObs $job)
    {
        //authorize

        //delete the job
        $job->delete();

        //redirect
        return redirect('/jobs');
    }
}
