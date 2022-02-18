<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guides', function (Blueprint $table) {
            $table->bigIncrements('guide_id');
            $table->string('guide_first_name',100)->nullable();
            $table->string('guide_last_name',100)->nullable();
            $table->string('guide_contact',100)->nullable();
              $table->text('guide_address')->nullable();
            $table->string('guide_country',100)->nullable();
            $table->string('guide_city',100)->nullable();
            $table->string('guide_language',100)->nullable();
            $table->text('guide_description')->nullable();
            $table->text('guide_image')->nullable();
            $table->string('guide_created_by',100)->nullable();
            $table->string('guide_role',100)->nullable();
            $table->integer('guide_status')->default(1);
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
        Schema::dropIfExists('guides');
    }
}
