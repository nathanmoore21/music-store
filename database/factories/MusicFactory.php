<?php

namespace Database\Factories;

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
    {
        return [
            'title' => $this->faker->word,
            'album' => $this->faker->text(50),
            'artist' => $this->faker->name,
            'genre' => $this->faker->text(50),
            'rating' => $this->faker->numberBetween(1, 10),
        ];
    }
}
