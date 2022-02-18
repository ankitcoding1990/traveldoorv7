<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSightseeingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sightseeings', function (Blueprint $table) {
            $table->id();
            $table->string('tour_name')->nullable();
            $table->string('tour_type')->nullable();
            $table->text('tour_desc')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->string('city_covered')->nullable();
            $table->unsignedBigInteger('from_city_id')->nullable();
            $table->json('city_between_ids')->nullable();
            $table->unsignedBigInteger('to_city_id')->nullable();
            $table->string('distance_covered')->nullable();
            $table->string('duration')->nullable();
            $table->unsignedBigInteger('fuel_type_id')->nullable();
            $table->string('food_cost')->nullable();
            $table->string('hotel_cost')->nullable();
            $table->string('adult_cost')->nullable();
            $table->string('child_cost')->nullable();
            $table->string('group_adult_cost')->nullable();
            $table->string('group_child_cost')->nullable();
            $table->integer('group_max_pax')->nullable();
            $table->text('group_tour_terms')->nullable();
            $table->string('default_guide_price')->nullable();
            $table->string('additional_cost')->nullable();
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();
            $table->string('discount')->nullable();
            $table->string('surge')->nullable();
            $table->string('no_of_pax')->nullable();
            $table->string('default_driver_price')->nullable();
            $table->text('attractions')->nullable();
            $table->unsignedBigInteger('created_admin_id')->nullable();
            $table->unsignedBigInteger('created_supplier_id')->nullable();
            $table->string('show_order')->nullable();
            $table->boolean('status')->default(0);
            $table->boolean('best_status')->default(0);
            $table->boolean('popular_status')->default(0);
            $table->boolean('draft_status')->default(1);
            $table->tinyInteger('admin_approval')->default(0);
            $table->timestamp('is_cloned')->nullable();
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('set null');
            $table->foreign('from_city_id')->references('id')->on('cities')->onDelete('set null');
            $table->foreign('to_city_id')->references('id')->on('cities')->onDelete('set null');
            $table->foreign('fuel_type_id')->references('id')->on('fuel_types')->onDelete('set null');
            $table->foreign('created_admin_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('created_supplier_id')->references('id')->on('suppliers')->onDelete('set null');
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
        Schema::dropIfExists('sightseeings');
    }
}
