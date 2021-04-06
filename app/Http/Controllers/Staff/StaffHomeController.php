<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Resources\Group as GroupResource;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Group;
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
    /**
     * Displays the groups
     *
     * @return \Illuminate\Http\Response
     */
    public function groups(Request $request)
    {
        $groups = Group::where('is_class', true)->get();
        if($request->ajax()){
            return GroupResource::collection($groups);
        }

        return "";
    }
}
