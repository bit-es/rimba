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

        Schema::create('movements', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ["transfer","promotion","demotion","assignment","end_of_assignment"]);
            $table->date('effective_date');
            $table->json('from')->nullable();
            $table->json('to')->nullable();
            $table->morphs('movable');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movements');
    }
};
