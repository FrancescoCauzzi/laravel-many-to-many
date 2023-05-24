<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run(Faker $faker)
    {
        $technologies = [
            'JavaScript',
            'HTML',
            'CSS',
            'Python',
            'PHP',
            'Ruby',
            'Java',
            'C#',
            'TypeScript',
            'VSCode',
            'Atom',
            'Go',
            'Rust',
            'Perl',
            'Postman',
            'Scala',
            'Lua',
            'MySQL',
            'Shell',
            'Figma',
        ];
        foreach ($technologies as $technology) {
            $newTech = new Technology();
            $newTech->name = $technology;
            $newTech->description = $faker->text(200);
            $newTech->website = $faker->url;
            $newTech->save();
        };
    }
}
