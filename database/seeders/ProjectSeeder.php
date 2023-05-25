<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;

use Faker\Generator as Faker;

use Illuminate\Support\Str;

use App\Models\Client;
use App\Models\User;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        for ($i = 0; $i < 10; $i++) {
            Project::create([
                // Store the generated name in a variable
                'name' => $name = $faker->sentence(3),

                // Use the stored name variable for slug generation
                'slug' => Str::slug($name, '-'),

                'description' => $faker->text(),
                'start_date' => now(),
                'end_date' => $faker->dateTimeBetween('now', '+3 years'),
                'status' => ['pending', 'in progress', 'completed'][array_rand(['pending', 'in progress', 'completed'])],


            ]);
        }
    }
}
