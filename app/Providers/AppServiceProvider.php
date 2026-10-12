<?php

namespace App\Providers;

use App\Models\Inquiry;
use App\Models\InternshipStream;
use App\Models\StudentProfile;
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

            View::composer('layouts.admin', function ($view) {
                try {
                    $totalApps = StudentProfile::count();
                    $pendingApps = StudentProfile::where('status', 'PENDING')->count();
                    $enrolled = StudentProfile::whereIn('status', ['APPROVED', 'ACTIVE', 'COMPLETED'])->count();
                    $pendingCert = StudentProfile::whereIn('status', ['APPROVED', 'ACTIVE', 'COMPLETED'])->where('certificate_issued', false)->count();
                    $issuedCert = StudentProfile::where('certificate_issued', true)->count();
                    $totalStreams = InternshipStream::count();
                    $totalInquiries = Inquiry::count();

                    $view->with('adminNavStats', [
                        'total' => $totalApps,
                        'pending' => $pendingApps,
                        'enrolled' => $enrolled,
                        'pending_cert' => $pendingCert,
                        'certificates_issued' => $issuedCert,
                        'total_streams' => $totalStreams,
                        'total_inquiries' => $totalInquiries,
                    ]);
                } catch (\Throwable $e) {
                    $view->with('adminNavStats', [
                        'total' => 0,
                        'enrolled' => 0,
                        'pending_cert' => 0,
                        'certificates_issued' => 0,
                        'total_streams' => 0,
                        'total_inquiries' => 0,
                    ]);
                }
            });
        } catch (\Throwable $e) {
            // Ignore database connection issues during migration / console commands
        }
    }
}
