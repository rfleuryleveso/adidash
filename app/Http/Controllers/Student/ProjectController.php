<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Auth::user()->groupProjects()->where('status', 'STARTED')->get();
        return view("student.projects.index", ["projects" => $projects]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $available_tasks = $project->tasks()->whereIn('status', ['WAITING', 'STARTED'])->get();
        return view("student.projects.project", ["project" => $project, "available_tasks" => $available_tasks]);
    }
}
