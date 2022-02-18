<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransferDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfer_details', function (Blueprint $table) {
            $table->bigIncrements('transfer_details_id');
            $table->string('transfer_id',10)->nullable();
            $table->string('transfer_details_type',20)->nullable();
            $table->string('from_city_airport',20)->nullable();
            $table->string('to_city_airport',20)->nullable();
            $table->text('transfer_vehicle_tariff')->nullable();
            $table->string('transfer_details_created_by',10)->nullable();
            $table->string('transfer_details_role',50)->nullable();
            $table->integer('transfer_details_status')->default(1);
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
        Schema::dropIfExists('transfer_details');
    }
}
