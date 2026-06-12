<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /* ============================================================
         | SHARED: ATTRIBUTES (ABAC BACKBONE)
         |============================================================ */
        Schema::create('abacs', function (Blueprint $table): void {
            $table->id();
            $table->string('code');              // plant, skill, grade
            $table->string('value')->nullable(); // string or json
            $table->string('value_type')->default('string');
            $table->timestamps();
        });

        Schema::create('abacables', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('abac_id')->constrained('abacs');
            $table->morphs('abacable');
            $table->timestamps();

            $table->unique([
                'abac_id',
                'abacable_id',
                'abacable_type',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('abacables');
        Schema::dropIfExists('abacs');
    }
};
