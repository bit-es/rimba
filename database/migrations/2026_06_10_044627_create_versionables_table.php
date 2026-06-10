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

        Schema::create('versionables', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ["document","workflow","template","service","config","other"]);
            $table->string('name');
            $table->foreignId('current_version_id')->nullable()->constrained('versions');
            $table->json('attributes')->nullable();
            $table->morphs('ref');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('versionables');
    }
};
