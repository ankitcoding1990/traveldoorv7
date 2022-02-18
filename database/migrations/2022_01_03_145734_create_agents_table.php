<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            // auth
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('verified_at')->nullable();
            $table->string('password_hint')->nullable();
            // other info
            $table->string('company_name')->nullable();
            $table->string('company_email')->nullable();
            $table->string('company_contact')->nullable();
            $table->string('company_fax')->nullable();
            //change agent_ref_id to user_ref_id
            $table->bigInteger('user_ref_id')->unsigned()->nullable();
            $table->text('address')->nullable();
            $table->bigInteger('country_id')->unsigned()->nullable();
            $table->bigInteger('city_id')->unsigned()->nullable();
            $table->string('corporate_reg_no')->nullable();
            $table->string('corporate_desc')->nullable();

            $table->string('skype_id')->nullable();
            // opening hours
            $table->string('operating_hrs_from')->nullable();
            $table->string('operating_hrs_to')->nullable();
            $table->text('operating_weekdays')->nullable();
            $table->string('certificate_corp')->nullable();

            $table->string('agent_logo')->nullable();
            $table->string('opr_currency')->nullable();
            $table->text('operate_country_id')->nullable();
            $table->bigInteger('created_user_id');
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
        Schema::dropIfExists('agents');
    }
}
