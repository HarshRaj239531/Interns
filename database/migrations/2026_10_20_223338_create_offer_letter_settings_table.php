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
        Schema::create('offer_letter_settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->default('INFINITY INTERNS');
            $table->string('company_subtitle')->default('A unit of Infinitya1 Career Counselling private limited');
            $table->string('cin_number')->default('U85500BR2025PTC075319');
            $table->string('address')->default('B-hub Maurya Lok Complex, Patna, Bihar – 800001');
            $table->string('email')->default('info@infinityinterns.com');
            $table->string('website')->default('www.infinityinterns.com');
            $table->string('logo_path')->nullable();
            $table->string('letter_title')->default('INTERNSHIP OFFER LETTER');
            $table->string('ref_prefix')->default('II/OL/');
            $table->string('default_role')->default('Financial Management Intern');
            $table->string('default_department')->default('Marketing & Finance');
            $table->string('default_location')->default('ON-OFFICE');
            $table->string('default_duration')->default('06 June 2026 to 21 July 2026');
            $table->string('default_stipend')->default('Rs 5000');
            $table->string('default_reporting_manager')->default('Aryav Singh Vishal');
            $table->string('default_mode')->default('Office');
            $table->integer('acceptance_days')->default(5);
            $table->text('intro_text')->nullable();
            $table->text('terms_text')->nullable();
            $table->text('closing_text')->nullable();
            $table->string('signatory_name')->default('Aryav Singh Vishal');
            $table->string('signatory_designation')->default('Authorized Signatory');
            $table->string('signature_path')->nullable();
            $table->string('seal_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offer_letter_settings');
    }
};
