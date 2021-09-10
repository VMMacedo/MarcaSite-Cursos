<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInscricaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscricao', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nome');
            $table->string('email');
            $table->string('cpf', 13);
            $table->string('cep', 9);
            $table->string('rua', 200);
            $table->string('bairro', 200);
            $table->string('numero', 200);
            $table->string('complemento', 20)->nullable();;
            $table->string('cidade', 200);
            $table->string('uf', 2);
            $table->string('empresa', 100);
            $table->string('telefone', 12)->nullable();
            $table->string('celular', 12);
            $table->string('categoria', 20);
            $table->boolean('status')->default('0');;
            $table->string('senha', 30);
            $table->bigInteger('cursoid')->unsigned();
            $table->foreign('cursoid')->references('id')->on('cursos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inscricaos');
    }
}
