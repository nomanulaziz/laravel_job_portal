<?php

namespace App\Policies;

use App\Models\Jobs;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class JobsPolicy
{
    /**
     * Determine whether the user can edit the job.
     */
    public function edit(User $user, Jobs $job): bool
    {
        // Is the employer of the job is 
        // the user who wants to edit the job
        // returns boolean
        return $job->employer->user->is($user);
    }

}
