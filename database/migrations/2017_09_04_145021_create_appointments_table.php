<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('appointments', function (Blueprint $table) {
          $table->increments('id_appointments');
          $table->string('name');
          $table->integer('phone')->unsigned();
          $table->dateTime('birthday');
          $table->string('email');
          $table->boolean('subscribe');
          $table->float('interes')->unsigned();
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
        Schema::dropIfExists('appointments');
    }
}
