<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('versions', function (Blueprint $table) {
            $table->id();

            $table->morphs('versionable');

            $table->json('data');
            $table->string('event')->default('manual');

            $table->unsignedInteger('major')->default(1);
            $table->unsignedInteger('minor')->default(0);
            $table->unsignedInteger('patch')->default(0);

            $table->string('semver')->index();

            // ✅ Content lives HERE now
            $table->string('content_path')->nullable();
            $table->string('content_url')->nullable();
            $table->string('content_type')->nullable();

            $table->text('notes')->nullable();

            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('versions');
    }
};
