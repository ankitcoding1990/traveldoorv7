<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnquiryRemarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enquiry_remarks', function (Blueprint $table) {
             $table->bigIncrements('enq_remarks_id');
            $table->string('enq_id',20)->nullable();
            $table->text('enquiry_remarks')->nullable();
            $table->string('given_by',20)->default('0');
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
        Schema::dropIfExists('enquiry_remarks');
    }
}
