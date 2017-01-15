<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function(Blueprint $table) {
            $table->increments('id');
            $table->boolean('personal');
            $table->string('event');
            $table->date('date_start');
            $table->date('date_end');
            $table->enum('status', ['Pendiente', 'Terminada'])->default('Pendiente');
            $table->integer('user_id')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')
                    ->references('id')
                    ->on('users');

            $table->foreign('client_id')
                    ->references('id')
                    ->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('services', function(Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['client_id']);
        });

        Schema::drop('services');
    }
}