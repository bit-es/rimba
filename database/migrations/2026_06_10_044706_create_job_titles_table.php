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
        Schema::disableForeignKeyConstraints();

        Schema::create('job_titles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('jobgrade')->nullable();
            $table->uuid('uuid')->unique();
            $table->text('description')->nullable();
            $table->json('attributes')->nullable();
            $table->string('masco_code')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_titles');
    }
};
