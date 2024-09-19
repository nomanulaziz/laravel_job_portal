<?php

namespace App\Providers;

use App\Models\Jobs;
use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     * Tiggered when all project dependencies have been loaded
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        Model::preventLazyLoading();

        // Implementing this gate logic because before that 
        // unauthorized user can see the edit post button
        // choose one with facade
        // Gate is like a barrier in real life
        // if authorized allow if not authorized no entry
        // custom name given 'edit-job' can be any.
        // In the view can be access using @can and @cannot directives
        Gate::define('edit-job', function (User $user, Jobs $job) {
            // Is the employer of the job is 
            // the user who wants to edit the job
            // returns boolean
            return $job->employer->user->is($user);
        });
    }
}
