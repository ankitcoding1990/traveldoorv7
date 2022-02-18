<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('restaurant_type_id')->unsigned();
            $table->string('name')->nullable();
            $table->string('owner_name')->nullable();
            $table->string('email')->nullable();
            $table->string('contact')->nullable();
            $table->bigInteger('supplier_id')->unsigned();
            $table->text('address')->nullable();
            $table->bigInteger('country_id')->unsigned();
            $table->bigInteger('city_id')->unsigned();
            $table->date('valid_from_date')->nullable();
            $table->date('valid_to_date')->nullable();
            $table->time('valid_from_time')->nullable();
            $table->time('valid_to_time')->nullable();
            $table->integer('no_of_tables')->nullable();
            $table->string('currency')->nullable();
            $table->longText('blackout_days')->nullable();
            $table->text('restaurant_available_days')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('available_for_delivery')->nullable();
            $table->boolean('drafted_status')->default(1);
            $table->boolean('status')->default(1);
            $table->integer('approve_status')->default(0);
            $table->boolean('best_seller_status')->default(0);
            $table->boolean('popular_status')->default(0);
            $table->integer('created_user_id')->nullable();
            $table->integer('created_supplier_id')->nullable();
            $table->foreign('restaurant_type_id')->references('id')->on('restaurant_types')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('city_id')->references('id')->on('cities');
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
        Schema::dropIfExists('restaurants');
    }
}
