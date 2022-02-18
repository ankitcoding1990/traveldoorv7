<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelMealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_meals', function (Blueprint $table) {
            $table->bigIncrements('hotel_meals_id');
              $table->string('hotel_meals_name',100)->nullable();
              $table->integer('hotel_meals_status')->default(1);
              $table->string('hotel_meals_created_by',10)->nullable();
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
        Schema::dropIfExists('hotel_meals');
    }
}
