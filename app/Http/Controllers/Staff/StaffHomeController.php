<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;

class StaffHomeController extends Controller
{
    public function home()
    {    
        $tasksAwaitingNotation = Task::where(
            [
                ['status', 'FINISHED'],
                ['notation_status', 'WAITING_FOR_STAFF']
            ]
        )->get();

        //Retrieve all values of project_id
        $projectIds = $tasksAwaitingNotation->pluck('project_id')->all();
        $projectAwaitingNotation = Project::where(
            [
                ['status', 'STARTED'],
            ]
            )
        //Cross search between project id and status
        ->whereIn('id', $projectIds)
        ->get();

        return view('staff.home.home', ['tasksAwaitingNotation'=>$tasksAwaitingNotation], ['projectAwaitingNotation'=>$projectAwaitingNotation]);
    }

}