<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_customer', function (Blueprint $table) {
            $table->bigIncrements('booking_id');
            $table->string('booking_type','50')->nullable();
            $table->string('booking_type_id','50')->nullable();
            $table->string('customer_login_id','50')->nullable();
            $table->string('customer_login_name','250')->nullable();
            $table->string('customer_login_email','250')->nullable();
            $table->string('booking_supplier_id','50')->nullable();
            $table->string('customer_name','250')->nullable();
            $table->string('customer_contact','250')->nullable();
            $table->string('customer_email','250')->nullable();
            $table->string('customer_country','20')->nullable();
            $table->text('customer_address')->nullable();
            $table->text('customer_remarks')->nullable();
            $table->string('booking_adult_count','20')->nullable();
            $table->string('booking_child_count','20')->nullable();
            $table->string('supplier_adult_price','20')->nullable();
            $table->string('supplier_child_price','20')->nullable();
            $table->string('customer_adult_price','20')->nullable();
            $table->string('customer_child_price','20')->nullable();
            $table->string('booking_currency','20')->nullable();
            $table->string('booking_amount','50')->nullable();
            $table->string('booking_markup_per','10')->nullable();
            $table->string('booking_remarks','50')->nullable();
            $table->string('booking_selected_date','50')->nullable();
            $table->string('booking_date','20')->nullable();
            $table->string('booking_time','20')->nullable();
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
        Schema::dropIfExists('booking_customer');
    }
}
