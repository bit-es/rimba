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

        Schema::create('job_positions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_contract_id')->constrained();
            $table->foreignId('org_unit_id')->constrained();
            $table->enum('level', ["junior", "mid", "senior", "lead", "manager"])->nullable();
            $table->enum('status', ["open", "filled", "closed"])->default('open');
            $table->string('title');
            $table->text('description')->nullable();
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
        Schema::dropIfExists('job_positions');
    }
};
