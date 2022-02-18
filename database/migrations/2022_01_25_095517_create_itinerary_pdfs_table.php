<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItineraryPdfsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itinerary_pdfs', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('header_title')->nullable();
            $table->text('about_text')->nullable();
            $table->text('content_desciption')->nullable();
            $table->string('contact_image')->nullable();
            $table->string('about_image')->nullable();
            $table->string('logo_image')->nullable();
            $table->string('banner_img_1')->nullable();
            $table->string('banner_img_2')->nullable();
            $table->boolean('pdf_status')->default(1);
            $table->string('created_by')->nullable();
            $table->string('created_by_role')->nullable();
            $table->string('color_code')->nullable();
            $table->string('invoice_logo_img')->nullable();
            $table->string('invoice_color_code')->nullable();
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
        Schema::dropIfExists('itinerary_pdfs');
    }
}
