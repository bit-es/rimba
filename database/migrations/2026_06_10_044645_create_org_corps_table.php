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

        Schema::create('org_corps', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('uuid')->unique();
            $table->string('code')->nullable();
            $table->enum('type', ["company","government","vendor","institution"])->nullable();
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
        Schema::dropIfExists('org_corps');
    }
};
