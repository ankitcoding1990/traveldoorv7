<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuideExpenseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('guide_expense', function (Blueprint $table) {
            $table->bigIncrements('guide_expense_id');
            $table->string('guide_expense',50)->nullable();
            $table->string('guide_expense_cost',10)->default(0);
            $table->string('guide_expense_created_by',10)->nullable();
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
        Schema::dropIfExists('guide_expense');
    }
}
