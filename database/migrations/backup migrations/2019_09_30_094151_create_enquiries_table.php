<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enquiries', function (Blueprint $table) {
            $table->bigIncrements('enq_id');
            $table->string('emp_id',20)->nullable();
            $table->text('organization_name')->nullable();
            $table->string('customer_name',100)->nullable();
            $table->string('customer_contact',50)->nullable();
            $table->string('customer_alt_contact',50)->nullable();
            $table->string('customer_email',100)->nullable();
            $table->string('customer_alt_email',100)->nullable();
            $table->string('passport_no',20)->nullable();
            $table->string('passport_validity',20)->nullable();
            $table->string('enquiry_type',20)->nullable();
            $table->text('address')->nullable();
            $table->string('area',100)->nullable();
            $table->string('customer_country',10)->nullable();
            $table->string('customer_city',80)->nullable();
            $table->string('customer_state',80)->nullable();
            $table->string('customer_zipcode',20)->nullable();
            $table->string('booking_range',50)->nullable();
            $table->string('no_of_days',10)->nullable();
            $table->string('no_of_adults',10)->default('0');
            $table->string('no_of_kids',10)->default('0');
            $table->string('hotel_type',50)->nullable();
            $table->text('budget_type')->nullable();
            $table->string('enquiry_source',50)->nullable();
            $table->string('enquiry_prospect',50)->nullable();
            $table->string('enquiry_status',50)->nullable();
            $table->string('assigned_to',50)->default('0');
            $table->string('nxt_followup_date',30)->nullable();
            $table->string('customer_dob',20)->nullable();
            $table->string('wedding_date',20)->nullable();
            $table->string('currency_exchange_rate_status',20)->default('0');
            $table->string('select_currency',20)->nullable();
            $table->string('select_currency_rate',20)->default('0');
            $table->string('have_visa',20)->default('0');
            $table->string('have_insurance_status',20)->default('0');
            $table->string('insurance_days',20)->default('0');
            $table->string('insurance_type',20)->nullable();
            $table->string('departure_country',10)->nullable();
            $table->string('departure_city',80)->nullable();
            $table->text('enquiry_locations')->nullable();
            $table->text('passenger_name')->nullable();
            $table->string('passenger_dob',20)->nullable();
            $table->string('passenger_pan_number',20)->nullable();
            $table->string('passenger_passport_no',20)->nullable();
            $table->string('gstin_no',30)->nullable();
            $table->integer('active_status')->default('1');
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
        Schema::dropIfExists('enquiries');
    }
}
