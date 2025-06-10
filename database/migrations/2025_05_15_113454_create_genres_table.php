<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Execução da Migration
     * Criação da Tabela Gêneros
     */
    public function up(): void
    {
        Schema::create('genres', function (Blueprint $table) {
            $table->primary('id');
            $table->increments('id');
            $table->string('genre');
        });
    }

    /**
     * Rollback das Migrations
     */
    public function down(): void
    {
        Schema::dropIfExists('genres');
    }
};
