<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class StaffProjectsController extends Controller
{
    //
    public function home()
    {
        $projects = Project::all();
        return view('staff.projects.projects', ['projects' => $projects]);
    }

    public function project(Project $project)
    {
        $tasks = $project->tasks;
        $users = $project->members()->withPivot('relation_type')->get();
        return view('staff.projects.project', ['project' => $project, 'tasks' => $tasks, 'users' => $users]);
    }
}
