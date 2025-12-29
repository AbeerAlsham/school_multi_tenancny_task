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
        Schema::create('schools_subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained('schools')->cascadeOnUpdate();
            $table->foreignId('subject_id')->constrained('subjects')->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schools_subjects');
    }
};
