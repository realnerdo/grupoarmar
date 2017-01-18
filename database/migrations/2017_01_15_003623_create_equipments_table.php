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
            $table->string('serial');
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

        Schema::create('equipment_picture', function(Blueprint $table) {
            $table->integer('equipment_id')->unsigned();
            $table->foreign('equipment_id')
                    ->references('id')
                    ->on('equipments');

            $table->integer('picture_id')->unsigned();
            $table->foreign('picture_id')
                    ->references('id')
                    ->on('pictures');

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
        Schema::table('equipments', function(Blueprint $table) {
            $table->dropForeign(['brand_id']);
            $table->dropForeign(['group_id']);
            $table->dropForeign(['warehouse_id']);
        });

        Schema::table('equipment_picture', function(Blueprint $table) {
            $table->dropForeign(['equipment_id']);
            $table->dropForeign(['picture_id']);
        });

        Schema::drop('equipments');
        Schema::drop('equipment_picture');
    }
}
