<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\StudentProfile;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SuperAdminPortalController extends Controller
{
    public function dashboard()
    {
        $dbConnection = config('database.default');
        $dbVersion = 'SQLite 3 (Relational SQL Engine)';
        try {
            if ($dbConnection === 'mysql') {
                $dbVersion = DB::select('select version() as v')[0]->v;
            } elseif ($dbConnection === 'sqlite') {
                $dbVersion = 'SQLite '.DB::select('select sqlite_version() as v')[0]->v;
            }
        } catch (\Throwable $e) {
            $dbVersion = 'Operational SQL Engine';
        }

        $stats = [
            'total_users' => User::count(),
            'students' => StudentProfile::count(),
            'admins' => User::whereIn('role', ['ADMIN', 'SUPER_ADMIN'])->count(),
            'inquiries' => Inquiry::count(),
            'partner_colleges' => 24,
            'db_connection' => $dbConnection,
            'db_version' => $dbVersion,
            'php_version' => PHP_VERSION,
            'laravel_version' => app()->version(),
        ];

        $colleges = [
            ['name' => 'Patna Science College, Patna University', 'region' => 'Patna, Bihar', 'students' => 184, 'status' => 'ACTIVE PARTNER'],
            ['name' => 'Magadh Mahila College, Patna', 'region' => 'Patna, Bihar', 'students' => 142, 'status' => 'ACTIVE PARTNER'],
            ['name' => 'College of Commerce, Arts & Science', 'region' => 'Patna, Bihar', 'students' => 210, 'status' => 'ACTIVE PARTNER'],
            ['name' => 'A.N. College, Patna', 'region' => 'Patna, Bihar', 'students' => 195, 'status' => 'ACTIVE PARTNER'],
            ['name' => 'Patna College, Patna University', 'region' => 'Patna, Bihar', 'students' => 130, 'status' => 'ACTIVE PARTNER'],
            ['name' => 'Magadh University Affiliated Colleges', 'region' => 'Bodh Gaya, Bihar', 'students' => 320, 'status' => 'MOU IN REVIEW'],
        ];

        $recentInquiries = Inquiry::latest()->take(5)->get();

        return view('superadmin.dashboard', compact('stats', 'colleges', 'recentInquiries'));
    }
}
