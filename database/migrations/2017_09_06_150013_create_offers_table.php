<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;



class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('offers', function (Blueprint $table) {
          $table->increments('id_offer');
          $table->string('name');
          $table->string('address');
          $table->text('description');
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
      DB::statement('ALTER TABLE offers ADD location POINT' );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offers');
    }
}
