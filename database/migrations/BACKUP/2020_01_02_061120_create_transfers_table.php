<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->bigIncrements('transfer_id');
            $table->string('transfer_name',255)->nullable();
            $table->text('transfer_description')->nullable();
            $table->integer('supplier_id')->default(0);
            $table->string('transfer_country',10)->nullable();
            $table->string('transfer_type',50)->nullable();
            $table->string('no_of_transfer_available',10)->nullable();
            $table->string('transfer_inclusions',50)->nullable();
            $table->string('transfer_exclusions',50)->nullable();
            $table->string('transfer_cancellation',50)->nullable();
            $table->string('transfer_terms_and_conditions',50)->nullable();
            $table->string('transfer_created_by',10)->nullable();
            $table->string('transfer_role',50)->nullable();
            $table->integer('transfer_status')->default(1);
            $table->integer('transfer_approve_status')->default(1);
            $table->string('transfer_show_order',5)->nullable();
            $table->integer('transfer_best_status')->default(0);
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
        Schema::dropIfExists('transfers');
    }
}
