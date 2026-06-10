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

        Schema::create('versions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('versionable_id')->constrained();
            $table->foreignId('created_by')->nullable()->constrained('staff', 'by');
            $table->foreignId('approved_by')->nullable()->constrained('staff', 'by');
            $table->foreignId('published_by')->nullable()->constrained('staff', 'by');
            $table->enum('status', ["draft","approved","published","archived","rejected"]);
            $table->enum('content_type', ["file","url","inline","json"])->nullable();
            $table->string('content_path')->nullable();
            $table->integer('major');
            $table->integer('minor');
            $table->integer('patch');
            $table->string('version');
            $table->string('change_summary')->nullable();
            $table->text('change_notes')->nullable();
            $table->boolean('is_menu');
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamp('effective_from')->nullable();
            $table->timestamp('effective_to')->nullable();
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
        Schema::dropIfExists('versions');
    }
};
