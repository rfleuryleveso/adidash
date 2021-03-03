<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\StaffSearchTasks;
use App\Http\Resources\Task as TaskResource;
use App\Http\Requests\StaffUpdateNotation;
use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Project;
use App\Models\Tag;
use App\Models\Task;
use Auth;

class StaffTasksController extends Controller
{

    //TODO : ADD NOTATION STATUS FILTER (WAITING FOR STAFF)
    //TODO : CHECK FILTER FUNCTIONNALITY 

    public function home(StaffSearchTasks $request, Project $project)
    {
        $tasksQuery = (new Task)->newQuery();
        //Building the Query block by block
        if ($request->ajax()) {
            return TaskResource::collection($tasksQuery->where('status', ['FINISHED'])->get());
        }
        if ($request->isMethod('post')) {
            if ($request->has('status')) {
                $tasksQuery->whereIn('status', $request->input('status'));
            }
            if ($request->has('name')) {
                $tasksQuery->where('name', 'LIKE', '%'. $request->input('name') . '%');
            }
            if($request->has('notation_status')) {
                $tasksQuery->where('notation_status', 'WAITING_FOR_STAFF');
            }
            
        }
        $tasks = $tasksQuery->paginate(10);

        return view('staff.tasks.tasks',['project' => $project], ['tasks' => $tasks]);
    }

    public function task(Project $project, Task $task)
    {
        $grades = $task->grades;
        $canChangeGrades = $task->notation_status == "WAITING_FOR_STAFF";
        return view('staff.tasks.task', ['project' => $project, 'task' => $task, 'grades' => $grades, 'canChangeGrades' => $canChangeGrades]);
    }

    public function StaffUpdateNotation(StaffUpdateNotation $request)
    {
        foreach ($request->grades as $grade) {
            Grade::updateOrCreate(
                ['task_id' => $request->task->id, 'user_id' => $grade['user'], 'evaluation_type' => 'STAFF'],
                ['grade' => $grade['grade'], 'evaluator_id' => Auth::id(), 'comments' => $grade['comments']]
            );
        }
        return redirect()->back()->with('success', 'Notes mises à jour');
    }
}