<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('genres', function (Blueprint $table) {
            //$table->integer('id')->unsigned();
            $table->primary('id');
            $table->increments('id');
            $table->string('genre');
        });
        
        Schema::create('games', function (Blueprint $table) {
            $table->uuid('uuid');
            $table->string('name');
            $table->string('description');
            $table->date('release_date');
            $table->string('developer');
            $table->string('publisher');
            $table->integer('genre_id')->unsigned();
            $table->index('genre_id');
            $table->foreign('genre_id')->references(columns: 'id')->on('genres');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
        Schema::dropIfExists('genres');
    }
};
