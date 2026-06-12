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

        Schema::create('workflow_transitions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workflow_id')->constrained();
            $table->foreignId('from_step_id')->constrained('workflow_steps');
            $table->foreignId('to_step_id')->constrained('workflow_steps');
            $table->string('name')->nullable();
            $table->json('conditions')->nullable();
            $table->boolean('requires_approval')->default(false);
            $table->json('extra')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workflow_transitions');
    }
};
