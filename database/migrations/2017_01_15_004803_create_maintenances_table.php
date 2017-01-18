<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaintenancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenances', function(Blueprint $table) {
            $table->increments('id');
            $table->string('reason');
            $table->text('description');
            $table->date('perform_date');
            $table->string('place');
            $table->string('responsible');
            $table->integer('equipment_detail_id')->unsigned();
            $table->integer('supplier_id')->unsigned();
            $table->timestamps();

            $table->foreign('equipment_detail_id')
                    ->references('id')
                    ->on('equipment_details');

            $table->foreign('supplier_id')
                    ->references('id')
                    ->on('suppliers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('maintenances', function(Blueprint $table) {
            $table->dropForeign(['equipment_detail_id']);
            $table->dropForeign(['supplier_id']);
        });

        Schema::drop('maintenances');
    }
}
