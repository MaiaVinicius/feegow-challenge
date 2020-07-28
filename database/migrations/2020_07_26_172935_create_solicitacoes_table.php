<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitacoesTable extends Migration
{
    public function up()
    {
        Schema::create('solicitacoes', function (Blueprint $table) {
            $table->string('specialty_id')->nullable();
            $table->string('professional_id')->nullable();
            $table->string('name')->nullable();
            $table->string('especialty')->nullable();
            $table->string('cpf')->nullable();
            $table->string('source_id')->nullable();
            $table->string('birthdate')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('solicitacoes');
    }
}
