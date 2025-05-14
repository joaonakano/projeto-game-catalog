<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
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
            'genre_id' => 1,
        ]);

        DB::table('games')->insert([
            'uuid' => uuid_create(),
            'name' => 'Yellow Half-Dead Redemption',
            'description' => 'A shooter game.',
            'release_date' => '2022-12-04',
            'developer' => 'Rockstar India',
            'publisher' => 'Rockstar North America',
            'genre_id' => 2,
        ]);

        DB::table('games')->insert([
            'uuid' => uuid_create(),
            'name' => 'Red Dead Redemption',
            'description' => 'A shooter game.',
            'release_date' => '2022-12-04',
            'developer' => 'Rockstar Yemen',
            'publisher' => 'Rockstar North America',
            'genre_id' => 3,
        ]);
    }
}
