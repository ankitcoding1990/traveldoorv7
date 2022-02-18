<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSightseeingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sightseeing', function (Blueprint $table) {
            $table->bigIncrements('sightseeing_id');
            $table->string('sightseeing_tour_name',255)->nullable();
            $table->text('sightseeing_tour_desc')->nullable();
            $table->string('sightseeing_country',20)->nullable();
            $table->string('sightseeing_city_covered',20)->nullable();
            $table->string('sightseeing_city_from',20)->nullable();
            $table->string('sightseeing_city_between',20)->nullable();
            $table->string('sightseeing_city_to',20)->nullable();
            $table->string('sightseeing_distance_covered',20)->nullable();
            $table->string('sightseeing_fuel_type',50)->nullable();
            $table->string('sightseeing_fuel_type_cost',50)->nullable();
            $table->string('sightseeing_total_fuel_cost',50)->nullable();
            $table->string('sightseeing_food_cost',50)->nullable();
            $table->string('sightseeing_hotel_cost',50)->nullable();
            $table->string('sightseeing_total_expense_cost',50)->nullable();
            $table->string('sightseeing_adult_cost',50)->nullable();
            $table->string('sightseeing_child_cost',50)->nullable();
            $table->string('sightseeing_created_by',50)->nullable();
            $table->string('sightseeing_create_role',50)->nullable();
            $table->string('sightseeing_status',50)->nullable();
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
        Schema::dropIfExists('sightseeing');
    }
}
