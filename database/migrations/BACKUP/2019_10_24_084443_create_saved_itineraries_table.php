<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSavedItinerariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saved_itineraries', function (Blueprint $table) {
            $table->bigIncrements('itinerary_id');
            $table->string('itinerary_tour_name',255)->nullable();
            $table->text('itinerary_tour_description')->nullable();
            $table->string('itinerary_occupancy',10)->nullable();
            $table->string('itinerary_adult',10)->nullable();
            $table->string('itinerary_child_with_bed',5)->nullable();
            $table->string('itinerary_child_with_no_bed',5)->nullable();
            $table->integer('itinerary_country')->default(0);
            $table->string('itinerary_tour_fromdate',20)->nullable();
            $table->string('itinerary_tour_todate',20)->nullable();
            $table->text('itinerary_tour_details')->nullable();
            $table->string('itinerary_created_by',10)->nullable();
            $table->string('itinerary_created_role',50)->nullable();
            $table->integer('itinerary_status')->default(1);
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
        Schema::dropIfExists('saved_itineraries');
    }
}
