<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleWiseCostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_wise_cost', function (Blueprint $table) {
            $table->bigIncrements('vehicle_cost_id');
            $table->string('vehicle_type',10)->nullable();
            $table->string('vehicle_type_cost',10)->default(0);
            $table->string('vehicle_cost_created_by',10)->nullable();
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
        Schema::dropIfExists('vehicle_wise_cost');
    }
}
