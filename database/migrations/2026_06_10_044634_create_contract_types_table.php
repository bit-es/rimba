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

        Schema::create('contract_types', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('name');
            $table->string('code')->unique();
            $table->text('description')->nullable();
            $table->longText('template')->nullable();
            $table->json('public_schema')->nullable();
            $table->json('confidential_schema')->nullable();
            $table->json('notify')->nullable();
            $table->integer('expiry_notify_days')->default(30);
            $table->boolean('requires_approval')->default(false);
            $table->boolean('requires_signature')->default(false);
            $table->foreignId('workflow_id')->nullable()->constrained();
            $table->json('meta')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_types');
    }
};
