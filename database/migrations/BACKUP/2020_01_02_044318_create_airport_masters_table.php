<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAirportMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airport_masters', function (Blueprint $table) {
             $table->bigIncrements('airport_master_id');
             $table->string('airport_master_name',100)->nullable();
              $table->integer('airport_master_status')->default(1);
               $table->string('airport_master_created_by',10)->nullable();
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
        Schema::dropIfExists('airport_masters');
    }
}
