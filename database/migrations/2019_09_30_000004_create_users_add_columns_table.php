<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersAddColumnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
          if (!Schema::hasColumn('users', 'users_pid')) {
              $table->integer('users_pid')->default('0');
          }
          if (!Schema::hasColumn('users', 'users_empcode')) {
              $table->string('users_empcode')->nullable();
          }
          if (!Schema::hasColumn('users', 'users_fname')) {
              $table->string('users_fname')->nullable();
          }
          if (!Schema::hasColumn('users', 'users_lname')) {
              $table->string('users_lname')->nullable();
          }
          if (!Schema::hasColumn('users', 'username')) {
              $table->string('username')->nullable();
          }
          if (!Schema::hasColumn('users', 'users_contact')) {
              $table->string('users_contact')->nullable();
          }
          if (!Schema::hasColumn('users', 'users_password_hint')) {
              $table->string('users_password_hint')->nullable();
          }
          if (!Schema::hasColumn('users', 'users_assigned_role')) {
              $table->string('users_assigned_role')->nullable();
          }
          if (!Schema::hasColumn('users', 'users_role')) {
              $table->string('users_role')->nullable();
          }
          if (!Schema::hasColumn('users', 'users_status')) {
              $table->string('users_status')->nullable();
          }
          if (!Schema::hasColumn('users', 'last_login')) {
              $table->timestamp('last_login')->nullable();
          }
          if (!Schema::hasColumn('users', 'users_partner_country')) {
              $table->bigInteger('users_partner_country')->unsigned()->nullable();
          }
          if (!Schema::hasColumn('users', 'user_service_type')) {
              $table->text('user_service_type')->nullable();
          }
          if (!Schema::hasColumn('users', 'user_service_markup')) {
              $table->text('user_service_markup')->nullable();
          }
          if (!Schema::hasColumn('users', 'user_own_service_markup')) {
              $table->text('user_own_service_markup')->nullable();
          }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('users', function (Blueprint $table) {

        if (Schema::hasColumn('users', 'users_pid')) {
            $table->dropColumn('users_pid');
        }
        if (Schema::hasColumn('users', 'users_empcode')) {
            $table->dropColumn('users_empcode');
        }
        if (Schema::hasColumn('users', 'users_fname')) {
            $table->dropColumn('users_fname');
        }
        if (Schema::hasColumn('users', 'users_lname')) {
            $table->dropColumn('users_lname');
        }
        if (Schema::hasColumn('users', 'username')) {
            $table->dropColumn('username');
        }
        if (Schema::hasColumn('users', 'users_contact')) {
            $table->dropColumn('users_contact');
        }
        if (Schema::hasColumn('users', 'users_password_hint')) {
            $table->dropColumn('users_password_hint');
        }
        if (Schema::hasColumn('users', 'users_assigned_role')) {
            $table->dropColumn('users_assigned_role');
        }
        if (Schema::hasColumn('users', 'users_role')) {
            $table->dropColumn('users_role');
        }
        if (Schema::hasColumn('users', 'users_status')) {
            $table->dropColumn('users_status');
        }
        if (Schema::hasColumn('users', 'last_login')) {
            $table->dropColumn('last_login');
        }
        if (Schema::hasColumn('users', 'users_partner_country')) {
            $table->dropColumn('users_partner_country')->unsigned();
        }
        if (Schema::hasColumn('users', 'user_service_type')) {
            $table->dropColumn('user_service_type');
        }
        if (Schema::hasColumn('users', 'user_service_markup')) {
            $table->dropColumn('user_service_markup');
        }
        if (Schema::hasColumn('users', 'user_own_service_markup')) {
            $table->dropColumn('user_own_service_markup');
        }
      });
    }
}
