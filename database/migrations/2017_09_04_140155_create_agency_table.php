<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgencyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */ 
    public function up()
    {
      Schema::create('agency', function (Blueprint $table) {
          $table->increments('id_agency');
          $table->string('name');
          $table->string('url');
          $table->string('address');
          $table->integer('user_id')->foreign()->references('id_user')->on('users');
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
        Schema::dropIfExists('agency');
    }
}
