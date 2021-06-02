<?php

namespace App\Http\Controllers\Committee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Group;
use App\Models\Project;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\Group as GroupResource;
use App\Http\Requests\CommitteeCreateProjectRequest;
use App\Notifications\ProjectAwaitingConfiguration;

class CommitteeController extends Controller
{

    /**
     * Returns a list of the committee's users
     */
    public function usersList()
    {
        $committeeGroup = Auth::user()->getCommitteeGroups()->first();
        $classGroup = $committeeGroup->parent();
        return $classGroup->first()->users()->get();
    }

    /**
     * Returns a list of the committee's projects
     */
    public function projectsList()
    {
        $committeeGroup = Auth::user()->getCommitteeGroups()->first();
        $classGroup = $committeeGroup->parent();
        return $classGroup->first()->projects()->get();
    }

    /**
     * Displays the committee home
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $users = $this->usersList()->count();
        $projects = $this->projectsList();
        return view('committee.home', ['users' => $users, 'projects' => $projects]);
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

        return view('committee.groups', ['groups' => $groups]);
    }



}
