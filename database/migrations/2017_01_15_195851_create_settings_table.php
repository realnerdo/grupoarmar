<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('owner');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->integer('sidebar_logo_id')->unsigned()->nullable();
            $table->integer('service_logo_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('sidebar_logo_id')
                    ->references('id')
                    ->on('pictures');

            $table->foreign('service_logo_id')
                    ->references('id')
                    ->on('pictures');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function(Blueprint $table) {
            $table->dropForeign(['sidebar_logo_id']);
            $table->dropForeign(['service_logo_id']);
        });

        Schema::drop('settings');
    }
}
