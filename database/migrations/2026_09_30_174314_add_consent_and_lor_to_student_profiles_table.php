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
            $table->boolean('consent_letter_issued')->default(true)->after('offer_letter_date');
            $table->timestamp('consent_letter_date')->nullable()->after('consent_letter_issued');
            $table->boolean('lor_issued')->default(false)->after('certificate_date');
            $table->string('lor_number')->nullable()->after('lor_issued');
            $table->timestamp('lor_date')->nullable()->after('lor_number');
            $table->text('lor_remarks')->nullable()->after('lor_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'consent_letter_issued',
                'consent_letter_date',
                'lor_issued',
                'lor_number',
                'lor_date',
                'lor_remarks',
            ]);
        });
    }
};
