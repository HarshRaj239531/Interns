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
        Schema::create('internship_streams', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('code')->unique();
            $table->string('category')->default('TECHNOLOGY'); // TECHNOLOGY, BUSINESS, SCIENCE, ARTS
            $table->string('duration')->default('8 Weeks (120 Contact Hours)');
            $table->string('credits')->default('4.0 NHEQF Credits');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internship_streams');
    }
};
