<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->bigIncrements('hotel_id');
            $table->string('hotel_name',255)->nullable();
            $table->integer('supplier_id')->default(0);
            $table->string('hotel_contact',50)->nullable();
            $table->string('hotel_rating',10)->nullable();
            $table->text('hotel_address')->nullable();
            $table->integer('hotel_country')->default(0);
            $table->integer('hotel_city')->default(0);
            $table->text('rate_allocation_details')->nullable();
            $table->text('hotel_promotion_details')->nullable();
            $table->text('hotel_add_ons')->nullable();
            $table->text('hotel_other_policies')->nullable();
            $table->string('booking_validity_from',20)->nullable();
            $table->string('booking_validity_to',20)->nullable();
            $table->text('hotel_inclusions')->nullable();
            $table->text('hotel_exclusions')->nullable();
            $table->text('hotel_cancel_policy')->nullable();
            $table->text('hotel_terms_conditions')->nullable();
            $table->text('hotel_images')->nullable();
            $table->string('hotel_created_by',10)->nullable();
            $table->string('hotel_create_role',50)->nullable();
            $table->integer('hotel_status')->default(1);
             $table->integer('hotel_approve_status')->default(1);
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
        Schema::dropIfExists('hotels');
    }
}
