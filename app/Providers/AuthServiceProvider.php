<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Adminlte3\Models\News;
use App\Policies\NewsPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        News::class => NewsPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        \Gate::define(
            'getIndex',
            function ($user) {
                return $user->id == 2;
            }
        );
    }
}
