<?php

namespace App\Http\Controllers\ProjectAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
use App\Models\Tag;
use App\Http\Requests\ProjectCreateTask;
use App\Http\Resources\Task as TaskResource;

class TasksController extends Controller
{
    public function home(Request $request, Project $project)
    {
        $tasksQuery = $project->tasks()->withoutGlobalScopes();
        if ($request->ajax()) {
            return TaskResource::collection($tasksQuery->whereNotIn('status', ['FINISHED', 'CANCELLED'])->get());
        }
        if ($request->isMethod('post')) {
            dd($request->all());
        }
        $tasks = $tasksQuery->paginate(10);
        return view('project-admin.tasks', ['project' => $project, 'tasks' => $tasks]);
    }


    
    public function create(ProjectCreateTask $request)
    {
        $task = new Task;
       
        $task->project_id = $request->route('project')->id;
        $task->fill($request->all());
        $task->status = (!!$request->parent_task) ? "WAITING_FOR_PARENT_TASK" : "WAITING";
        $task->save();

        if ($request->tags) {
            foreach ($request->tags as $tagId) {
                $tag = Tag::find($tagId);
                $task->tags()->attach($tag);
            }
        }
        

        return redirect()->route('project-admin.tasks', ['project' => $task->project_id]);
    }
}
