<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubAmentiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_amenities', function (Blueprint $table) {
           $table->bigIncrements('sub_amenities_id');
             $table->string('amenities_id',10)->nullable();
            $table->string('sub_amenities_name',100)->nullable();
            $table->string('sub_amenities_icon',100)->nullable();
            $table->integer('sub_amenities_status')->default(1);
             $table->string('sub_amenities_created_by',10)->nullable();
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
        Schema::dropIfExists('sub_amenities');
    }
}
