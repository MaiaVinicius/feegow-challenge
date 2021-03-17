<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FeegowDataForm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feegow_data', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('specialty_id');
            $table->integer('professional_id');
            $table->bigInteger('cpf');
            $table->integer('source_id');
            $table->date('birthdate');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feegow_data');
    }
}
