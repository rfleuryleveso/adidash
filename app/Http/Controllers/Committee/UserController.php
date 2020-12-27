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

class UserController extends CommitteeController
{

    /**
     * Displays the class list
     *
     * @return \Illuminate\Http\Response
     */
    public function users(Request $request)
    {
        $users = parent::usersList();
        if($request->ajax()){
            return UserResource::collection($users);
        }
        
        return view('committee.users', ['users' => $users]);
    }


    /**
    * Displays one user
    *
    * @return \Illuminate\Http\Response
    */
    public function user(User $user)
    {
        return view('committee.user', ['user' => $user]);
    }


}
