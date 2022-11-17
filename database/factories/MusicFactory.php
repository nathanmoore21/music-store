<?php

namespace Database\Factories;

use App\Models\Artist;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Music>
 */
class MusicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    //inserts fake data to the table
    {
        $artists = Artist::all();
        return [
            'title' => $this->faker->word,
            'album' => $this->faker->text(50),
            'genre' => $this->faker->text(50),
            'rating' => $this->faker->numberBetween(1, 10),
            'artist_id' => $artists->random()->id,
        ];
    }
}
