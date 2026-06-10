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

        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('module_id')->nullable()->constrained();
            $table->foreignId('staff_id')->constrained();
            $table->foreignId('evaluator_id')->nullable()->constrained('users');
            $table->enum('result', ["pass","fail"])->nullable();
            $table->timestamp('evaluated_at')->nullable();
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
        Schema::dropIfExists('evaluations');
    }
};
