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
        Schema::create('certificate_settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->default('INFINITY INTERNS');
            $table->string('tagline')->default('LEARN • GROW • SUCCEED');
            $table->string('title')->default('CERTIFICATE OF COMPLETION');
            $table->string('director_name')->default('Rahul Kumar');
            $table->string('director_title')->default('Director, Infinity Interns');
            $table->string('company_unit')->default('Infinity A1 Career Counselling Pvt. Ltd.');
            $table->string('stamp_signature_path')->nullable();
            $table->string('msme_logo_path')->nullable();
            $table->string('aicte_logo_path')->nullable();
            $table->string('default_mode')->default('Offline');
            $table->string('default_duration')->default('45 Days');
            $table->string('website_url')->default('https://infinityinterns.com/');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificate_settings');
    }
};
