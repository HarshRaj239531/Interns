<?php

namespace App\Providers;

use App\Models\InternshipStream;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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
        try {
            if (Schema::hasTable('internship_streams')) {
                $activeStreams = InternshipStream::where('is_active', true)->orderBy('title')->get();
                View::share('activeStreams', $activeStreams);
            }
        } catch (\Throwable $e) {
            // Ignore database connection issues during migration / console commands
        }
    }
}
