<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Job;
use App\Models\User;
use App\Policies\JobPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
      //  Job::class => JobPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('favorite-job' , function (User $user){
            return $user->roleIs('freelancer');
        });
        Gate::define('send-message' , function (User $user){
            return $user->roleIs('freelancer');
        });
        Gate::define('see-message' , function (User $user){
            return $user->roleIs('client');
        });
    }
}
