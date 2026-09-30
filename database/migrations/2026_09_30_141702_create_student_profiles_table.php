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
        Schema::create('student_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('application_number')->unique();
            $table->string('degree');
            $table->string('college');
            $table->string('semester');
            $table->string('program_domain');
            $table->string('status')->default('PENDING'); // PENDING, APPROVED, ACTIVE, COMPLETED, REJECTED
            $table->boolean('offer_letter_issued')->default(false);
            $table->timestamp('offer_letter_date')->nullable();
            $table->boolean('certificate_issued')->default(false);
            $table->string('certificate_number')->nullable()->unique();
            $table->timestamp('certificate_date')->nullable();
            $table->boolean('marksheet_issued')->default(false);
            $table->string('marksheet_grade')->nullable();
            $table->integer('marksheet_marks')->nullable();
            $table->timestamp('marksheet_date')->nullable();
            $table->integer('attendance_rate')->default(92);
            $table->string('mentor_name')->default('Faculty Advisory Board');
            $table->string('project_title')->default('Undergraduate Domain Capstone Report');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_profiles');
    }
};
