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
            $table->bigIncrements('users_id');
            $table->integer('users_pid')->default('0');
            $table->string('users_empcode',100)->nullable();
            $table->string('users_fname',100)->nullable();
            $table->string('users_lname',100)->nullable();
            $table->string('users_username',100)->nullable();
            $table->string('users_contact',100)->nullable();
            $table->string('users_email',100)->nullable();
            $table->string('users_password',100)->nullable();
            $table->string('users_password_hint',100)->nullable();
            $table->string('users_assigned_role',100)->nullable();
            $table->string('users_role',100)->nullable();
            $table->string('users_status',100)->nullable();
            $table->timestamps('last_login')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
