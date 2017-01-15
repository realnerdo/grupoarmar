<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_details', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('quantity');
            $table->integer('equipment_id')->unsigned();
            $table->integer('service_id')->unsigned();
            $table->timestamps();

            $table->foreign('equipment_id')
                    ->references('id')
                    ->on('equipments');

            $table->foreign('service_id')
                    ->references('id')
                    ->on('services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_details', function(Blueprint $table) {
            $table->dropForeign(['equipment_id']);
            $table->dropForeign(['service_id']);
        });

        Schema::drop('service_details');
    }
}
