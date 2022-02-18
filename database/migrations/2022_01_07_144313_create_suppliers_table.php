<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            // auth
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('password_hint')->nullable();

            // end auth

            $table->string('company_name')->nullable();
            $table->string('company_email')->nullable();
            $table->string('company_contact')->nullable();
            $table->string('company_fax')->nullable();
            $table->string('user_ref_id')->nullable();
            $table->text('address')->nullable();
            $table->bigInteger('country_id')->unsigned();
            $table->bigInteger('city_id')->unsigned();

            $table->string('corporate_reg_no')->nullable();
            $table->text('corporate_desc')->nullable();
            $table->string('skype_id')->nullable();
            $table->string('fuel_info')->nullable();
            $table->text('operating_hrs_from')->nullable();
            $table->text('operating_hrs_to')->nullable();
            $table->text('operating_weekdays')->nullable();
            $table->string('certificate_corp')->nullable();
            $table->string('logo')->nullable();
            $table->text('opr_currency')->nullable();
            $table->text('opr_countries')->nullable();
            $table->text('blackout_dates')->nullable();
            $table->string('created_by')->nullable();
            $table->string('created_by_role')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('suppliers');
    }
}
