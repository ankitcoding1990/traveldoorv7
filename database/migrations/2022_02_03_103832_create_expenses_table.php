<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('expense_type')->nullable();
            $table->bigInteger('expense_category_id')->unsigned()->nullable();
            $table->date('expense_occured_on')->nullable();
            $table->float('expense_amount',8,2)->nullable();
            $table->text('expense_remarks')->nullable();
            $table->string('expense_created_by')->nullable();
            $table->foreign('expense_category_id')->references('id')->on('income_expense_category');
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
        Schema::dropIfExists('expenses');
    }
}
