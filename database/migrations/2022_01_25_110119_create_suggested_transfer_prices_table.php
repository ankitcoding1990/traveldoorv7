<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuggestedTransferPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suggested_transfer_prices', function (Blueprint $table) {
            $table->id();
            $table->string('transfer_type')->nullable();
            $table->string('from_city_airport')->nullable();
            $table->string('to_city_airport')->nullable();
            $table->bigInteger('transfer_vehicle_type_id')->unsigned();
            $table->integer('suggested_transfer_vehicle_cost')->default(0);
            $table->foreign('transfer_vehicle_type_id')->references('id')->on('vehicle_type')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suggested_transfer_prices');
    }
}
