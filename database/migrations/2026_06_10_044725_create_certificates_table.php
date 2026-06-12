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

        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('module_id')->constrained();
            $table->foreignId('staff_id')->constrained();
            $table->foreignId('quiz_attempt_id')->nullable()->constrained();
            $table->foreignId('evaluation_id')->nullable()->constrained();
            $table->foreignId('issued_by')->nullable()->constrained('users');
            $table->enum('status', ["valid","expired","revoked"])->default('valid');
            $table->timestamp('issued_at')->nullable();
            $table->timestamp('expires_at')->nullable();
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
        Schema::dropIfExists('certificates');
    }
};
