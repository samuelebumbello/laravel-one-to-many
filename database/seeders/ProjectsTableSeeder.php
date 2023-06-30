<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projects = config('projects');
        foreach($projects as $project);
        $new_project =  New Project();
        $new_project->category_id = Category::inRandomOrder()->first()->id;
        $new_project->title = $project['title'];
        $new_project->slug = Project::generateSlug($new_project->title);
        // $new_project->type = $project['type'];
        $new_project->thumb = $project['thumb'];
        $new_project->date_creation = $project['date_creation'];
        $new_project->description = $project['description'];
        $new_project->save();
    }
}
