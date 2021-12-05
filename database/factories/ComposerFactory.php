<?php

namespace Database\Factories;

use App\Models\Composer;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComposerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Composer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'sex' => $this->faker->randomElement(['male','female'])
        ];
    }
}
