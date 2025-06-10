<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    /**
     * Execução da Migration
     * Criação da Tabela Jogo/Gênero para um Jogo que tenha mais de um gênero
     */
    public function up(): void
    {
        Schema::create('game_genre', function (Blueprint $table) {
            $table->id('game_genre_id');
            $table->primary('game_genre_id');
            
            $table->uuid('game_id');
            $table->foreign('game_id')
                  ->references('uuid')
                  ->on('games')
                  ->onDelete('cascade');

            $table->integer('genre_id')->unsigned();
            $table->foreign('genre_id')
                  ->references('id')
                  ->on('genres');
        });
    }

    /**
     * Rollback da Migration
     */
    public function down(): void
    {
        Schema::dropIfExists('game_genre');
    }
};
