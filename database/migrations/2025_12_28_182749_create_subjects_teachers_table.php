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
        Schema::create('subjects_teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subject_id')->constrained('subjects')->cascadeOnUpdate();
            $table->foreignId('teacher_id')->constrained('users')->cascadeOnUpdate();
            $table->foreignId('school_id')->constrained('schools')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects_teachers');
    }
};
