<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->boolean('is_admin')->default(0);
            $table->boolean('is_banned')->default(0);

        });
    }

    /**
     * C:\Users\msi\OneDrive\Desktop\Project\database\migrations\2014_10_12_000000_create_users_table.php
     * Reverse the migrations.
     *
     * database\migrations\2014_10_12_000000_create_users_table.php
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
