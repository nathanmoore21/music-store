<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Music;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    //will create 3 rows of data for the genre table. this will choose 1-3 musics(songs) and attach them to genres
    {
        Genre::factory()
            ->times(3)
            ->create();

        foreach (Genre::all() as $genre) {
            $musics = Music::inRandomOrder()->take(rand(1, 3))->pluck('id');
            //attach($musics) is what stores music_id and genre_id in the pivot table.
            $genre->musics()->attach($musics);
        }
    }
}
