<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ActorSeeder::class);
        $this->call(ComposerSeeder::class);
        $this->call(DirectorSeeder::class);
        $this->call(ReviewSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(ReviewSeeder::class);
        $this->call(MovieSeeder::class);
    }
}
