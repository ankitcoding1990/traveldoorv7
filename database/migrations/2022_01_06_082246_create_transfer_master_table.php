<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfer_master', function (Blueprint $table) {
            $table->id();
            $table->string('master_name')->nullable();
            $table->string('master_country')->nullable();
            $table->string('master_city')->nullable();
            $table->string('master_type')->nullable();
            $table->string('master_status')->default(1);
            $table->string('master_created_by')->nullable();
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
        Schema::dropIfExists('transfer_master');
    }
}
