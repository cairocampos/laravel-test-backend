<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImoveisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imoveis', function (Blueprint $table) {
            $table->id();
            $table->string('email_proprietario');
            $table->char('cep',8);
            $table->string('rua');
            $table->string('bairro');
            $table->string('numero');
            $table->string('complemento')->nullable();
            $table->string('cidade');
            $table->char('estado', 2);
            $table->char('cor', 10)->nullable();
            $table->smallInteger('total_divisoes');
            $table->tinyInteger('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imoveis');
    }
}
