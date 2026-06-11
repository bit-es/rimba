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

        Schema::create('org_units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('org_corp_id')->nullable()->constrained();
            $table->foreignId('parent_id')->nullable()->constrained('org_units');
            $table->string('name');
            $table->string('uuid')->unique();
            $table->string('code')->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('org_units');
    }
};
