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
        Schema::create('attributes', function (Blueprint $table): void {
            $table->id();
            $table->string('code');              // plant, skill, grade
            $table->string('value')->nullable(); // string or json
            $table->string('value_type')->default('string');
            $table->timestamps();
        });

        Schema::create('attributables', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('attribute_id')->constrained('attributes');
            $table->morphs('attributable');
            $table->timestamps();

            $table->unique([
                'attribute_id',
                'attributable_id',
                'attributable_type',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attributables');
        Schema::dropIfExists('attributes');
    }
};
