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

        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('requester_id')->constrained('staff');
            $table->foreignId('workflow_instance_id')->nullable()->constrained();
            $table->enum('status', ["submitted","in_review","approved","rejected","in_progress","completed","closed"])->default('submitted');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('request_type')->nullable();
            $table->json('extra')->nullable();
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
        Schema::dropIfExists('requests');
    }
};
