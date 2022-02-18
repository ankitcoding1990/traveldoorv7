<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnquiryCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enquiry_comments', function (Blueprint $table) {
            $table->bigIncrements('enq_comments_id');
            $table->string('enq_id',20)->nullable();
            $table->text('enq_comments')->nullable();
            $table->text('enq_comments_file')->nullable();
            $table->string('enq_status',20)->nullable();
            $table->string('enq_nxtfollowup_date',30)->nullable();
            $table->text('reason_failure')->nullable();
            $table->integer('response_email_status')->default('0');
            $table->integer('response_sms_status')->default('0');
            $table->text('response_email_text')->nullable();
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
        Schema::dropIfExists('enquiry_comments');
    }
}
