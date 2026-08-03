<?php

namespace App\Providers;

<<<<<<< HEAD
use Illuminate\Foundation\Support\Providers\AuthServiceProvider AS ServiceProvider;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;
use App\Models\User;
use App\Policies\DashboardPolicy;

class AppServiceProvider extends ServiceProvider
{
    protected $policies = [
        User::class     => DashboardPolicy::class
    ];

=======
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
>>>>>>> 7fe10870449df8d307f7f7f883236694e2066e3d
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
<<<<<<< HEAD
        Paginator::useBootstrapFive();
        Carbon::setLocale('id');
        $this->registerPolicies();
        
=======
        //
>>>>>>> 7fe10870449df8d307f7f7f883236694e2066e3d
    }
}
