<?php

namespace Database\Seeders;

use App\Models\Actor;
use App\Models\Composer;
use App\Models\Country;
use App\Models\Director;
use App\Models\Movie;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Movie::factory()->count(20)->create()->each(function($movie) {
            $movie->actors()->saveMany(Actor::inRandomOrder()->limit(5)->get());
            $movie->directors()->saveMany(Director::inRandomOrder()->limit(2)->get());
            $movie->composers()->saveMany(Composer::inRandomOrder()->limit(3)->get());
            $movie->countries()->saveMany(Country::inRandomOrder()->limit(2)->get());
        });
    }
}
