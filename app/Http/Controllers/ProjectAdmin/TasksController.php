<?php

namespace App\Http\Controllers\ProjectAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Http\Requests\ProjectCreateTask;
use App\Http\Resources\Task as TaskResource;

class TasksController extends Controller
{
    public function home(Request $request, Project $project)
    {
        if ($request->ajax()) {
            return TaskResource::collection($project->tasks()->whereNotIn('status', ['FINISHED', 'CANCELLED'])->get());
        }
        $tasks = $project->tasks()->paginate(15);
        return view('project-admin.tasks', ['project' => $project, 'tasks' => $tasks]);
    }


    
    public function create(ProjectCreateTask $request)
    {
        dd($request->all());
    }
}
