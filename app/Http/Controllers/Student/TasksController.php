<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Resources\Task as TaskResource;
use App\Models\Task;
use App\Http\Requests\StudentUpdateTaskStatus;
use Illuminate\Http\Request;
use Auth;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userTasks = Auth::user()->tasks;

        $memberProjectsTasks = Auth::user()->projects->map(function ($project) {
            return $project->tasks()->available()->get();
        })->reduce(function($carry, $projectTasks) {
            $carry = $carry->merge($projectTasks);
            return $carry;
        }, collect());

        return view('student.tasks.tasks', ['userTasks' => $userTasks, 'memberProjectsTasks' => $memberProjectsTasks]);
    }


    /**
     * Display the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Task $task)
    {
        if ($request->ajax()) {
            return new TaskResource($task);
        }
        $project = $task->project;
        return view("student.tasks.task", ["task" => $task, 'project' => $project]);
    }

    /**
     * Make the user join a specific task
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function join(Request $request, Task $task)
    {
        $task->users()->attach(Auth::user());
        return redirect()->back()->with('success', 'Vous avez rejoint cette tâche');
    }

    /**
     * Make the user leave a specific task
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function leave(Request $request, Task $task)
    {
        $task->users()->detach(Auth::user());
        return redirect()->back()->with('success', 'Vous avez quitté cette tâche');
    }

    /**
     * Update the task and set it's status
     *
     * @param \Illuminate\Http\Requests\StudentUpdateTaskStatus $request
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function setStatus(StudentUpdateTaskStatus $request, Task $task)
    {
        $task->status = $request->status;
        if ($request->status == "FINISHED") {
            $task->ended_at = now();
        }
        $task->save();
        return redirect()->back()->with('success', 'Vous avez mis à jour cette tâche');
    }
}
