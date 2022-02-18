<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('coupan_type')->nullable();
            $table->string('coupan_name')->nullable();
            $table->string('no_of_person')->nullable();
            $table->string('min_value')->nullable();
            $table->string('coupan_code')->nullable();
            $table->date('coupan_validity_from');
            $table->date('coupan_validity_to');
            $table->string('coupan_amount_type')->nullable();
            $table->string('coupan_amount')->nullable();
            $table->string('coupan_created_by')->nullable();
            $table->boolean('coupan_status')->default(1);
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
        Schema::dropIfExists('coupons');
    }
}
