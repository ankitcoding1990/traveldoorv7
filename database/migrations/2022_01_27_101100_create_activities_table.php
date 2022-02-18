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
            $table->id();
            $table->bigInteger('activity_type_id')->unsigned();
            $table->string('name')->nullable();
            $table->integer('supplier_id')->nullable();
            $table->text('location')->nullable();
            $table->integer('country_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->string('duration')->nullable();
            $table->date('valid_from')->nullable();
            $table->date('valid_to')->nullable();
            $table->time('time_from')->nullable();
            $table->time('time_to')->nullable();
            $table->string('currency')->nullable();
            $table->longText('blackout_days')->nullable();
            $table->json('activity_available_days')->nullable();
            $table->string('booking_type')->nullable();
            $table->json('age_groups')->nullable();
            $table->text('inclusions')->nullable();
            $table->text('exclusions')->nullable();
            $table->text('description')->nullable();
            $table->text('cancel_policy')->nullable();
            $table->text('terms_conditions')->nullable();
            $table->text('confirm_message')->nullable();
            $table->boolean('status')->default(0);
            $table->integer('created_user_id')->nullable();
            $table->integer('created_supplier_id')->nullable();
            $table->timestamp('is_cloned')->nullable();
            $table->foreign('activity_type_id')->references('id')->on('activity_type')->onDelete('cascade');
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
        Schema::dropIfExists('activities');
    }
}
