<?php

namespace Database\Seeders;

use App\Models\Artist;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ArtistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    //will create rows of data for the artist table
    {
        Artist::factory()
            ->times(3)
            ->hasMusics(4)
            ->create();
    }
}
