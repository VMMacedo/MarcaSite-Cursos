<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerfilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfils', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nome');
        });
        /**MUDANDO A TABELA COLOCANDO A CHAVE ESTRANGEIRA NO CAMPO QUE ARMAZENA O ID DO PERFIL */
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('id_perfil')->references('id')->on('perfils')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perfils');
    }
}
