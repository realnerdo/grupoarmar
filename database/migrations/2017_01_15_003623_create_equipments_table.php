<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipments', function(Blueprint $table) {
            $table->increments('id');
            $table->string('folio');
            $table->string('title');
            $table->text('description');
            $table->integer('stock')->unsigned()->nullable();
            $table->integer('brand_id')->unsigned();
            $table->integer('group_id')->unsigned();
            $table->integer('warehouse_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('brand_id')
                    ->references('id')
                    ->on('brands');

            $table->foreign('group_id')
                    ->references('id')
                    ->on('groups');

            $table->foreign('warehouse_id')
                    ->references('id')
                    ->on('warehouses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('equipments', function(Blueprint $table) {
            $table->dropForeign(['brand_id']);
            $table->dropForeign(['group_id']);
            $table->dropForeign(['warehouse_id']);
        });

        Schema::drop('equipments');
    }
}
