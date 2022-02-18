<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubAmenitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_amenities', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('amenities_id')->unsigned();
            $table->string('sub_amenities_name')->nullable();
            $table->string('sub_amenities_icon')->nullable();
            $table->boolean('sub_amenities_status')->default(1);
            $table->string('sub_amenities_created_by')->nullable();
            $table->foreign('amenities_id')->references('id')->on('amenities')->onDelete('cascade');
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
        Schema::dropIfExists('sub_amenities');
    }
}
