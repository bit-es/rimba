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

        Schema::create('job_contracts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('org_unit_id')->nullable()->constrained();
            $table->foreignId('org_team_id')->nullable()->constrained();
            $table->enum('type', ["permanent","contract","temporary","outsource"])->nullable();
            $table->enum('status', ["draft","active","on_hold","closed"])->default('active');
            $table->integer('position_limit')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
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
        Schema::dropIfExists('job_contracts');
    }
};
