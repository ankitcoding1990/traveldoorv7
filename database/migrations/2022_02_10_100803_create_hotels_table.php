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
            $table->id();
            $table->string('hotel_name');
            $table->unsignedBigInteger('hotel_type_id')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->string('hotel_contact')->nullable();
            $table->string('location')->nullable();
            $table->string('hotel_rating')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->text('reasons_to_book')->nullable();
            $table->text('season_details')->nullable();
            $table->text('blackout_dates')->nullable();
            $table->text('markup_details')->nullable();
            $table->text('surcharge_details')->nullable();
            $table->text('allocation_details')->nullable();
            $table->text('promotion_details')->nullable();
            $table->text('addon_details')->nullable();
            $table->string('booking_validity_from')->nullable();
            $table->string('booking_validity_to')->nullable();
            $table->text('description')->nullable();
            $table->text('other_policies')->nullable();
            $table->text('inclusions')->nullable();
            $table->text('exclusions')->nullable();
            $table->text('terms_conditions')->nullable();
            $table->text('cancel_policy')->nullable();
            $table->text('confirm_message')->nullable();
            $table->text('supplier_terms_conditions')->nullable();
            $table->text('supplier_cancel_policy')->nullable();
            $table->text('supplier_confirm_message')->nullable();
            $table->unsignedBigInteger('created_admin_id')->nullable();
            $table->bigInteger('show_order')->nullable();
            $table->boolean('status')->default(0);
            $table->boolean('best_status')->default(0);
            $table->boolean('popular_status')->default(0);
            $table->boolean('draft_status')->default(1);
            $table->tinyInteger('admin_approval')->default(0);
            $table->timestamp('is_cloned')->nullable();
            $table->foreign('hotel_type_id')->references('id')->on('hotel_type')->onDelete('set null');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('set null');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('set null');
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('set null');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('set null');
            $table->foreign('created_admin_id')->references('id')->on('users')->onDelete('set null');
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
        Schema::dropIfExists('hotels');
    }
}
