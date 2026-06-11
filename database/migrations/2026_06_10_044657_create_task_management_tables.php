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
        Schema::create('work_package_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('task_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->foreignId('role_id')->nullable()->constrained('roles')->nullOnDelete();
            // Automation hooks
            $table->string('pretask_action')->nullable();
            $table->string('posttask_action')->nullable();
            // UI / navigation
            $table->string('action_url')->nullable();
            $table->timestamps();
        });
        Schema::create('work_package_template_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('work_package_template_id')->constrained()->cascadeOnDelete();
            $table->foreignId('task_template_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('seq');
            $table->unsignedInteger('list');
            $table->unsignedInteger('order')->nullable();
            $table->timestamps();
            // Optional index for performance
            $table->index(['work_package_template_id', 'seq']);
        });
        Schema::create('work_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('work_package_template_id')->nullable()->constrained()->nullOnDelete();
            // Polymorphic reference
            $table->string('ref_type')->nullable();
            $table->unsignedBigInteger('ref_id')->nullable();
            $table->string('status')->default('queue');
            $table->timestamps();
            // Index for polymorphic lookup
            $table->index(['ref_type', 'ref_id']);
        });
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('work_package_id')->constrained()->cascadeOnDelete();
            $table->foreignId('task_template_id')->nullable()->constrained()->nullOnDelete();
            // Snapshot fields
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedInteger('seq');
            $table->unsignedInteger('list');
            // Assignment
            $table->foreignId('role_id')->nullable()->constrained('roles')->nullOnDelete();
            $table->foreignId('staff_id')->nullable()->constrained('staff')->nullOnDelete();
            // Status lifecycle
            $table->string('status')->default('planned');
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            // Action URL
            $table->string('action_url')->nullable();
            $table->timestamps();
            // Performance index
            $table->index(['work_package_id', 'seq', 'status']);
        });
        Schema::create('task_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained();
            $table->foreignId('role_id')->nullable()->constrained();
            $table->foreignId('staff_id')->nullable()->constrained();
            $table->foreignId('assigned_by')->nullable()->constrained('staff');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_assignments');
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('work_packages');
        Schema::dropIfExists('work_package_template_items');
        Schema::dropIfExists('task_templates');
        Schema::dropIfExists('work_package_templates');
    }
};
