<?php

namespace App\Providers;

use App\Models\Degree;
use App\Models\Inquiry;
use App\Models\InternshipStream;
use App\Models\School;
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
            if (Schema::hasTable('degrees')) {
                $activeDegrees = Degree::where('is_active', true)->orderBy('sort_order')->orderBy('name')->get();
                View::share('activeDegrees', $activeDegrees);
            }

            if (Schema::hasTable('schools')) {
                $activeSchools = School::where('is_active', true)->orderBy('name')->get();
                View::share('activeSchools', $activeSchools);
            }

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
                    $totalDegrees = Schema::hasTable('degrees') ? Degree::count() : 0;
                    $totalSchools = Schema::hasTable('schools') ? School::count() : 0;
                    $totalStreams = Schema::hasTable('internship_streams') ? InternshipStream::count() : 0;
                    $totalInquiries = Inquiry::count();

                    $view->with('adminNavStats', [
                        'total' => $totalApps,
                        'pending' => $pendingApps,
                        'enrolled' => $enrolled,
                        'pending_cert' => $pendingCert,
                        'certificates_issued' => $issuedCert,
                        'total_degrees' => $totalDegrees,
                        'total_schools' => $totalSchools,
                        'total_streams' => $totalStreams,
                        'total_academic_setup' => $totalDegrees + $totalSchools + $totalStreams,
                        'total_inquiries' => $totalInquiries,
                    ]);
                } catch (\Throwable $e) {
                    $view->with('adminNavStats', [
                        'total' => 0,
                        'enrolled' => 0,
                        'pending_cert' => 0,
                        'certificates_issued' => 0,
                        'total_degrees' => 0,
                        'total_schools' => 0,
                        'total_streams' => 0,
                        'total_academic_setup' => 0,
                        'total_inquiries' => 0,
                    ]);
                }
            });
        } catch (\Throwable $e) {
            // Ignore database connection issues during migration / console commands
        }
    }
}
