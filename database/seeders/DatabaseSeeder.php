<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Execução do Seeder das tabelas de Jogos, Gêneros e Jogo/Gênero
     */
    public function run(): void
    {
        DB::table('genres')->insert([
            'genre' => 'Western'
        ]);

        DB::table('genres')->insert([
            'genre' => 'Shooter'
        ]);

        DB::table('genres')->insert([
            'genre' => 'Puzzle'
        ]);

        DB::table('games')->insert([
            'uuid' => uuid_create(),
            'name' => 'Green Alive Redemption',
            'description' => 'A shooter game.',
            'release_date' => '2022-12-04',
            'developer' => 'Rockstar Rio',
            'publisher' => 'Rockstar North America',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('games')->insert([
            'uuid' => $uuid1 = uuid_create(),
            'name' => 'Yellow Half-Dead Redemption',
            'description' => 'A shooter game.',
            'release_date' => '2022-12-04',
            'developer' => 'Rockstar India',
            'publisher' => 'Rockstar North America',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('games')->insert([
            'uuid' => uuid_create(),
            'name' => 'Red Dead Redemption',
            'description' => 'A shooter game.',
            'release_date' => '2022-12-04',
            'developer' => 'Rockstar Yemen',
            'publisher' => 'Rockstar North America',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('game_genre')->insert([
            ['game_id' => $uuid1, 'genre_id' => 1],
            ['game_id' => $uuid1, 'genre_id' => 2],
            ['game_id' => $uuid1, 'genre_id' => 3],
        ]);
    }
}
