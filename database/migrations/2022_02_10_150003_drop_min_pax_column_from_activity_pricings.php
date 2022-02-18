<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropMinPaxColumnFromActivityPricings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activity_pricings', function (Blueprint $table) {
            if (Schema::hasColumn('activity_pricings', 'min_pax')) {
                $table->dropColumn('min_pax');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activity_pricings', function (Blueprint $table) {
            //
        });
    }
}
