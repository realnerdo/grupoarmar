<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipmentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment_details', function(Blueprint $table) {
            $table->increments('id');
            $table->string('folio');
            $table->integer('equipment_id')->unsigned();
            $table->timestamps();

            $table->foreign('equipment_id')
                ->references('id')
                ->on('equipments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('equipment_details', function(Blueprint $table) {
            $table->dropForeign(['equipment_id']);
        });

        Schema::drop('equipment_details');
    }
}
