<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * SUPPORT / Reporting
 * Intent:
 * Store report and dashboard definitions for operational
 * and management visibility.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->json('definition');
            $table->timestamps();
        });

        Schema::create('dashboards', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->json('layout');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
        Schema::dropIfExists('dashboards');
    }
};
