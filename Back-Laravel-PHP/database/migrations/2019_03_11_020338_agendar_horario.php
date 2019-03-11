<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgendarHorario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendarHorario', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('specialty_id');
            $table->integer('profissional_id');
            $table->integer('cpf');
            $table->integer('listsources');
            $table->date('birthdate');
            $table->string('nome');
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
        //
    }
}
