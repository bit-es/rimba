<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * FOUNDATION / Workflow
 * Intent:
 * Provide a generic workflow engine to manage lifecycle states,
 * approvals, and business process transitions.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('workflows', function (Blueprint $table): void {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('workflow_states', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('workflow_id')->constrained('workflows');
            $table->string('code');
            $table->string('label');
            $table->timestamps();
        });

        Schema::create('workflow_transitions', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('workflow_id')->constrained('workflows');
            $table->foreignId('from_state_id')->constrained('workflow_states');
            $table->foreignId('to_state_id')->constrained('workflow_states');
            $table->boolean('requires_approval')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workflow_instances');
        Schema::dropIfExists('workflow_states');
        Schema::dropIfExists('workflows');
    }
};
