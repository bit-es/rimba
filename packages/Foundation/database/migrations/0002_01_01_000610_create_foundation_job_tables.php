<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /* ============================================================
         | JOB DOMAIN
         |============================================================ */
        Schema::create('job_roles', function (Blueprint $table): void {
            $table->id();
            $table->string('code')->unique();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('job_positions', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('org_unit_id')->constrained('org_units');
            $table->date('effective_from')->nullable();
            $table->date('effective_to')->nullable();
            $table->timestamps();
        });

        Schema::create('job_position_roles', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('job_position_id')->constrained('job_positions');
            $table->foreignId('job_role_id')->constrained('job_roles');
            $table->timestamps();

            $table->unique([
                'job_position_id',
                'job_role_id',
            ]);
        });

        Schema::create('job_contracts', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('job_position_id')->constrained('job_positions');
            $table->foreignId('staff_id')->constrained('staff');

            $table->string('staff_type');      // FTE, FTC, TPC, INTERN
            $table->string('legal_employer');  // company or agency
            $table->string('headcount_type');  // internal / external
            $table->string('agreement_type');  // COS, MSA, Internship

            $table->date('start_date');
            $table->date('end_date')->nullable();

            $table->timestamps();
        });

        /* ============================================================
         | TEAM ↔ ROLE (SOW RESPONSIBILITY)
         |============================================================ */
        Schema::create('org_team_job_roles', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('org_team_id')->constrained('org_teams');
            $table->foreignId('job_role_id')->constrained('job_roles');
            $table->timestamps();

            $table->unique(['org_team_id', 'job_role_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('org_team_job_roles');
        Schema::dropIfExists('job_contracts');
        Schema::dropIfExists('job_position_roles');
        Schema::dropIfExists('job_positions');
        Schema::dropIfExists('job_roles');
    }
};
