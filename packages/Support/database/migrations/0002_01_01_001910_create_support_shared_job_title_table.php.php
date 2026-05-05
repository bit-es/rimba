<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_titles', function (Blueprint $table): void {
            $table->id();
            $table->string('title'); // Job title
            $table->string('jobgrade')->nullable(); // Job grade
            $table->string('uuid')->unique(); // Unique identifier for cross-system mapping
            $table->longText('description')->nullable(); // Detailed description
            $table->json('attributes')->nullable();
            // attributes will store tasks, basic_skills, specific_skills, knowledge, interest
            // Example: { "tasks": "...", "basic_skills": "...", "specific_skills": "...", "knowledge": "...", "interest": "..." }
            $table->string('masco_code')->nullable(); // MASCO code
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('job_titles');
    }
};
