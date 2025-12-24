<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\ValueRecord;
use App\Observers\ValueRecordObserver;

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
        ValueRecord::observe(ValueRecordObserver::class);    }
}