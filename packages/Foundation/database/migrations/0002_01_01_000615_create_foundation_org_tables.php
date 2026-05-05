<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * FOUNDATION / Org
 * Intent:
 * Represent organizational structure including companies,
 */
return new class extends Migration
{
    public function up(): void
    {
        /* ============================================================
            | ORG DOMAIN
            |============================================================ */
        Schema::create('organizations', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('uuid')->unique(); // Unique identifier for cross-system mapping
            $table->string('description')->nullable();
            $table->string('type')->nullable(); // company, plant, gov
            $table->date('effective_from')->nullable();
            $table->date('effective_to')->nullable();
            $table->timestamps();
        });

        Schema::create('org_units', function (Blueprint $table): void {
            $table->id();
            $table->string('uuid')->unique(); // Unique identifier for cross-system mapping
            $table->foreignId('organization_id')->nullable()->constrained('organizations');
            $table->string('code')->nullable();
            $table->string('name');
            $table->foreignId('owner_job_position_id')->nullable()->constrained('job_positions');
            $table->timestamps();
        });

        Schema::create('org_teams', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('organization_id')->constrained('organizations');
            $table->string('name');
            $table->foreignId('owner_staff_id')->nullable()->constrained('staff');
            $table->timestamps();
        });

        Schema::create('org_team_members', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('org_team_id')->constrained('org_teams');
            $table->foreignId('staff_id')->constrained('staff');
            $table->timestamps();

            $table->unique(['org_team_id', 'staff_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('org_team_members');
        Schema::dropIfExists('org_teams');
        Schema::dropIfExists('org_units');
        Schema::dropIfExists('organizations');
    }
};
