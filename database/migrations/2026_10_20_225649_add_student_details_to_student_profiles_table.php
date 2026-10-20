<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('student_profiles', function (Blueprint $table) {
            $table->string('gender')->nullable()->after('semester');
            $table->string('father_name')->nullable()->after('gender');
            $table->string('university_reg_no')->nullable()->after('father_name');
            $table->string('university_roll_no')->nullable()->after('university_reg_no');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'gender',
                'father_name',
                'university_reg_no',
                'university_roll_no',
            ]);
        });
    }
};
