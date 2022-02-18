<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transport', function (Blueprint $table) {
            $table->bigIncrements('transport_id');
            $table->string('transfer_name',255)->nullable();
            $table->integer('supplier_id')->default(0);
            $table->string('driver_language',255)->nullable();
            $table->integer('transfer_country')->default(0);
            $table->integer('transfer_city')->default(0);
            $table->text('transfer_pickup_point')->nullable();
            $table->text('transfer_drop_point')->nullable();
            $table->text('transfer_meet_point')->nullable();
            $table->text('transfer_description')->nullable();
            $table->string('transfer_arrival_time',20)->nullable();
            $table->text('operating_weekdays')->nullable();
            $table->text('transfer_blackout_dates')->nullable();
            $table->text('nationality_markup_details')->nullable();
            $table->text('transfer_transport_tariff')->nullable();
            $table->text('transfer_inclusions')->nullable();
            $table->text('transfer_exclusions')->nullable();
            $table->text('transfer_cancel_policy')->nullable();
            $table->text('transfer_terms_conditions')->nullable();
            $table->text('transfer_images')->nullable();
            $table->string('transfer_created_by',10)->nullable();
            $table->string('transfer_create_role',50)->nullable();
            $table->integer('transfer_status')->default(1);
            $table->integer('transport_approve_status')->default(1);
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
        Schema::dropIfExists('transport');
    }
}
