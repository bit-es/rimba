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

        Schema::create('job_contracts', function (Blueprint $table): void {
            $table->id();
            $table->string('uuid')->unique(); // Unique identifier for cross-system mapping
            $table->foreignId('job_title_id')->nullable()->constrained('job_titles');
            $table->foreignId('staff_id')->nullable()->constrained('staff');
            $table->foreignId('issuing_org_corp_id')->constrained('org_corps');
            // Contract Basics
            $table->enum('contract_type', ['FTE', 'FTC', 'TPC', 'INTERN'])->nullable(); // Full-Time Employee, Fixed-Term Contract, Third-Party Contractor, Intern
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_contracts');
    }
};
