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

        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('contract_type_id')->constrained();
            $table->foreignId('org_corp_id')->nullable()->constrained();
            $table->string('contract_no')->nullable();
            $table->string('title');
            $table->text('summary')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->date('renewal_date')->nullable();
            $table->enum('status', ["draft","pending","active","expired","terminated","archived"])->default('draft');
            $table->json('terms')->nullable();
            $table->json('meta')->nullable();
            $table->morphs('contractable');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
