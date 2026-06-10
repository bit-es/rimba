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

        Schema::create('workflow_decisions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workflow_instance_id')->constrained();
            $table->foreignId('workflow_step_id')->constrained();
            $table->foreignId('user_id')->constrained('staff');
            $table->enum('decision', ["approve","reject","request_changes"]);
            $table->text('comment')->nullable();
            $table->timestamp('decided_at');
            $table->json('attributes')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workflow_decisions');
    }
};
