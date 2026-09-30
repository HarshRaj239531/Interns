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
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('STUDENT'); // STUDENT, COLLEGE
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('degree')->nullable();
            $table->string('college')->nullable();
            $table->string('institution_name')->nullable();
            $table->string('coordinator_name')->nullable();
            $table->string('designation')->nullable();
            $table->string('city')->nullable();
            $table->string('student_count')->nullable();
            $table->text('message')->nullable();
            $table->string('status')->default('NEW');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};
