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
          $table->bigIncrements('agent_id');
            $table->text("agent_name")->nullable();
            $table->text("company_name")->nullable();
            $table->string("company_email",100)->nullable();
            $table->string("agent_password",200)->nullable();
            $table->string("agent_password_hint",200)->nullable();
            $table->string("company_contact",100)->nullable();
            $table->string("company_fax",50)->nullable();
            $table->string("agent_ref_id",50)->nullable();
            $table->text("address")->nullable();
            $table->string("agent_country",10)->nullable();
            $table->string("corporate_reg_no",50)->nullable();
            $table->text("corporate_desc")->nullable();
            $table->string("skype_id",50)->nullable();
            $table->string("operating_hrs_from",10)->nullable();
            $table->string("operating_hrs_to",10)->nullable();
            $table->text("operating_weekdays")->nullable();
            $table->text("certificate_corp")->nullable();
            $table->text("agent_logo")->nullable();
            $table->text("agent_opr_currency")->nullable();
            $table->text("agent_opr_countries")->nullable();
            $table->text("agent_bank_details")->nullable();
            $table->text("agent_service_type")->nullable();
            $table->text("contact_persons")->nullable();
            $table->string("agent_created_by",10)->nullable();
            $table->integer("agent_status")->default(1);
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
        Schema::dropIfExists('agents');
    }
}
