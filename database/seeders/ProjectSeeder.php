<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


use Faker\Generator as Faker;
use App\Models\Project;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for($i=0; $i<10; $i++){
            $project = new Project();

            $project->title = $faker->sentence(5);
            $project->descriptions = $faker->text(300);
            $project->thumb = $faker->imageUrl(250, 200);
            $project->languages = $faker->sentence(10);
            $project->slug = Str::slug($project->title, '-');
            
            $project->save();
        };
    }
}
