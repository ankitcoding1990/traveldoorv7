<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingTargetCommissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_target_commission', function (Blueprint $table) {
            $table->id();
            $table->string('st_amount')->nullable();
            $table->string('st_commission_per')->nullable();
            $table->boolean('st_status')->default(1);
            $table->string('st_created_by')->nullable();
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
        Schema::dropIfExists('setting_target_commission');
    }
}
