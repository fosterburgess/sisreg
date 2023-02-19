<?php

namespace App\Providers;

use App\Models\Reg\Org;
use App\Observers\OrgObserver;
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
     */
    public function boot(): void
    {
        Org::observe(OrgObserver::class);
    }
}
