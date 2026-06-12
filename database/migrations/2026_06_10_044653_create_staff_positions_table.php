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

        Schema::create('staff_positions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id')->constrained();
            $table->foreignId('job_position_id')->constrained();
            $table->enum('assignment_type', ["primary","secondary","acting"])->default('primary');
            $table->enum('status', ["active","ended","pending"])->default('active');
            $table->date('start_date');
            $table->date('end_date')->nullable();
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
        Schema::dropIfExists('staff_positions');
    }
};
