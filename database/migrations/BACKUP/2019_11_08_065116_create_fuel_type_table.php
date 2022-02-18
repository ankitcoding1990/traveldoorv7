<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuelTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuel_type', function (Blueprint $table) {
            $table->bigIncrements('fuel_type_id');
            $table->string('fuel_type',50)->nullable();
            $table->string('fuel_type_cost',10)->default(0);
            $table->string('fuel_type_created_by',10)->nullable();
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
        Schema::dropIfExists('fuel_type');
    }
}
