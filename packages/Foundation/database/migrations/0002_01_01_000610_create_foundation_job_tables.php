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
            $table->string('title'); // Job title
            $table->foreignId('org_unit_id')->nullable()->constrained('org_units');
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
            $table->string('uuid')->unique(); // Unique identifier for cross-system mapping
            $table->foreignId('job_position_id')->nullable()->constrained('job_positions');
            $table->foreignId('staff_id')->nullable()->constrained('staff');

            // Contract Basics
            $table->enum('contract_type', ['FTE', 'FTC', 'TPC', 'INTERN'])->nullable(); // Full-Time Employee, Fixed-Term Contract, Third-Party Contractor, Intern
            $table->date('start_date');
            $table->date('end_date')->nullable();

            $table->foreignId('compensation_id')->nullable()->constrained('job_compensations'); // Compensation
            
            $table->timestamps();
        });
         Schema::create('job_compensations', function (Blueprint $table): void {
            $table->id();
            $table->decimal('base_salary', 12, 2)->nullable();
            $table->string('currency', 3)->default('MYR');
            $table->enum('payment_frequency', ['monthly', 'bi_weekly', 'weekly']);
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
