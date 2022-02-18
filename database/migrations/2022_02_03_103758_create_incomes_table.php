<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->string('incomes_type')->nullable();
            $table->bigInteger('incomes_category_id')->unsigned()->nullable();
            $table->date('incomes_occured_on')->nullable();
            $table->float('incomes_amount',8,2)->nullable();
            $table->text('incomes_remarks')->nullable();
            $table->string('incomes_created_by')->nullable();
            $table->foreign('incomes_category_id')->references('id')->on('income_expense_category');
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
        Schema::dropIfExists('incomes');
    }
}
