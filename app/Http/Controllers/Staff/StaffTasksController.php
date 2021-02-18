<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\StaffSearchTasks;
use App\Http\Resources\Task as TaskResource;
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

    public function home(StaffSearchTasks $request)
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
                $tasksQuery->where('notation_status', ['WAITING_FOR_STAFF']);
            }
        }
        $tasks = $tasksQuery->paginate(10);
        
        return view('staff.tasks.tasks', ['tasks' => $tasks]);
    }
}