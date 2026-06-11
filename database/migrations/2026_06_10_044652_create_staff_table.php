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

        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->foreignId('org_corp_id')->nullable()->constrained();
            // $table->foreignId('org_unit_id')->nullable()->constrained();
            $table->foreignId('job_contract_id')->nullable()->constrained();
            $table->enum('type', ["FTE","FTC","TPC","Intern"])->default('FTE');
            $table->enum('status', ["active","inactive","suspended"])->default('active');
            $table->string('name')->nullable();
            $table->string('staff_no')->nullable();
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
        Schema::dropIfExists('staff');
    }
};
