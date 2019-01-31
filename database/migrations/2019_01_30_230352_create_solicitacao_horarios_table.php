<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitacaoHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitacao_horarios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('specialty_id');
            $table->integer('professional_id');
            $table->integer('source_id');
            $table->string('name',100);
            $table->string('cpf',15);
            $table->date('birthdate');
            $table->dateTime('date_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitacao_horarios');
    }

}
