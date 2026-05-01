<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /* ============================================================
         | PERSON DOMAIN
         |============================================================ */
        Schema::create('staff', function (Blueprint $table): void {
            $table->id();
            $table->string('full_name');
            $table->string('staff_type'); // FTE, FTC, TPC, INTERN
            $table->foreignId('user_id')->constrained('users')->nullable();
            $table->timestamps();
        });

        Schema::create('employees', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('staff_id')->constrained('staff')->unique();
            $table->string('employee_no')->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
        Schema::dropIfExists('staff');
    }
};
