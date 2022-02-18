<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->bigIncrements('activity_id');
            $table->string('activity_name',255)->nullable();
            $table->integer('supplier_id')->default(0);
            $table->text('activity_location')->nullable();
            $table->integer('activity_country')->default(0);
            $table->integer('activity_city')->default(0);
            $table->string('operation_period_fromdate',20)->nullable();
            $table->string('operation_period_todate',20)->nullable();
            $table->string('validity_fromdate',20)->nullable();
            $table->string('validity_todate',20)->nullable();
            $table->string('validity_fromtime',20)->nullable();
            $table->string('validity_totime',20)->nullable();
            $table->text('operating_weekdays')->nullable();
            $table->string('activity_currency',20)->nullable();
            $table->string('adult_price',30)->nullable();
            $table->string('child_price',30)->nullable();
            $table->text('activity_blackout_dates')->nullable();
            $table->text('nationality_markup_details')->nullable();
            $table->text('activity_transport_pricing')->nullable();
            $table->text('activity_inclusions')->nullable();
            $table->text('activity_exclusions')->nullable();
            $table->text('activity_cancel_policy')->nullable();
            $table->text('activity_terms_conditions')->nullable();
            $table->text('activity_images')->nullable();
            $table->string('activity_created_by',10)->nullable();
            $table->string('activity_role',50)->nullable();
            $table->integer('activity_status')->default(1);
            $table->integer('activity_approve_status')->default(1);
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
        Schema::dropIfExists('activities');
    }
}
