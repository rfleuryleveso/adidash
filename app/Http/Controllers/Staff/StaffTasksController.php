<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaffTasksController extends Controller
{

    public function list()
    {
        $tasks = Task::all('tasks')->get();
        return view('staff.tasks', ['projects' => $projects, 'tasks' => $tasks], ['grades' => $grades]);
    }

    public function index()
    {
        return view('staff.tasks.tasks');
    }

    
    public function show(Request $request, Task $task)
    {
        if ($request->ajax()) {
            return new TaskResource($task);
        }
        $project = $task->project;
        return view("staff.tasks.task", ["task" => $task, 'project' => $project]);
    }
}
