<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
       Schema::create('properties', function (Blueprint $table) {
           $table->increments('id_offer');
           $table->string('name');
           $table->string('address');
           $table->text('description');
           $table->double('latitude');
           $table->double('longitude');
           $table->bigInteger('euro')->unsigned();
           $table->bigInteger('leke')->unsigned();
           $table->text('note');
           $table->boolean('active');
           $table->integer('city_id')->foreign()->references('id_city')->on('city');
           $table->integer('type_id')->foreign()->references('id_type')->on('types');
           $table->integer('user_id')->foreign()->references('id_user')->on('users');
           $table->integer('bankAgent_id')->foreign()->references('id_bankAgent')->on('bankAgent');
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
         Schema::dropIfExists('properties');
     }
}
