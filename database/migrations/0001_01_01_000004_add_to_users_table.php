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
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->nullable();
            $table->string('password')->nullable()->change();
            $table->text('app_authentication_secret')->nullable();
            $table->string('ldap_domain')->nullable();
            $table->string('ldap_guid', 36)->nullable()->index();
            $table->string('employee_id')->nullable();
            $table->string('department')->nullable();
            $table->string('title')->nullable();
            $table->string('manager_dn')->nullable();
            $table->boolean('bio_readonly')->default(false);

            $table->unique('username');
            $table->unique('ldap_guid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
