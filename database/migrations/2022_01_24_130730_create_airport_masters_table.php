<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('airport_master_name')->nullable();
            $table->string('airport_master_country')->nullable();
            $table->string('airport_master_city')->nullable();
            $table->boolean('airport_master_status')->default(1);
            $table->string('airport_master_created_by')->nullable();
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
        Schema::dropIfExists('airport_masters');
    }
}
