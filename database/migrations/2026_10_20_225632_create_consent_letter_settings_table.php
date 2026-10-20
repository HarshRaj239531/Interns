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
        Schema::create('consent_letter_settings', function (Blueprint $table) {
            $table->id();
            $table->string('default_college')->default('GAYA COLLEGE, GAYA.');
            $table->string('annexure_text')->default('ANNEXURE I');
            $table->string('letter_title')->default('CONSENT LETTER');
            $table->string('letter_subject')->default('TO WHOM IT MAY CONCERN');
            $table->string('letter_no_prefix')->default('GC/CL/');
            $table->string('credits_text')->default('minimum 04 credits (120 hrs)');
            $table->text('intro_text')->nullable();
            $table->string('authority_designation')->default('Signature of HOD / Principal with Seal');
            $table->string('signature_path')->nullable();
            $table->string('seal_path')->nullable();
            $table->boolean('show_signature_line')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consent_letter_settings');
    }
};
