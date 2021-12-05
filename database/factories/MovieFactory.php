<?php

namespace Database\Factories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Movie::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'description' => $this->faker->text($maxNbChars = 150),
            'tagline' => $this->faker->sentence($nbWords = 3, $variableNbWords = true),
            'year' => $this->faker->year($max = 'now'),
            'budget' => $this->faker->numerify('##########'),
            'duration' => $this->faker->numberBetween(30, 250),
        ];
    }
}
