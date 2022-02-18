<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_rights', function (Blueprint $table) {
            $table->bigIncrements('rights_id');
            $table->integer('emp_id')->default(0);
            $table->text('menu')->nullable();
            $table->integer('add_status')->default(0);
            $table->integer('view_status')->default(0);
            $table->integer('edit_del_status')->default(0);
            $table->integer('report_status')->default(0);
            $table->integer('admin_status')->default(0);
            $table->text('admin_which_status')->nullable();
            $table->integer('rights_status')->default(0);
            $table->string('rights_date',20)->nullable();
            $table->string('rights_time',20)->nullable();
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
        Schema::dropIfExists('user_rights');
    }
}
