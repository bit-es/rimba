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
        //-------------------------------------------
        // MIGRATION: create_tasks_table.php
        //-------------------------------------------
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->foreignId('role_id')->nullable()->constrained('roles');
            $table->foreignId('staff_id')->nullable()->constrained('staff');
            $table->foreignId('task_list_id')->nullable()->constrained('task_lists');
            $table->string('status')->default('pending');
            $table->string('completion_action')->nullable(); // direct override
            $table->json('payload')->nullable();
            $table->timestamps();
        });

        Schema::create('task_lists', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->foreignId('role_id')->nullable()->constrained('roles');
            $table->string('completion_action')->nullable();
            $table->json('payload')->nullable();
            $table->timestamps();
        });

        Schema::create('taskables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained()->cascadeOnDelete();
            $table->morphs('taskable');
            $table->string('relation_type')->nullable();
            $table->timestamps();
        });

        Schema::create('task_listables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_list_id')->constrained()->cascadeOnDelete();
            $table->morphs('task_listable');
            $table->integer('order')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_listables');
        Schema::dropIfExists('taskables');
        Schema::dropIfExists('task_lists');
        Schema::dropIfExists('tasks');
    }
};
