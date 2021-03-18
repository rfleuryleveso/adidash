<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminGroupToggleUser;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;

class AdminGroupsController extends Controller
{
    public function home()
    {
        $groups = Group::withCount('users')->get();
        return view('administration.groups', ['groups' => $groups]);
    }

    public function edit(Group $group)
    {
        $groups = Group::all();
        $allUsers = User::all();
        $users = $group->users()->get();
        return view('administration.group', ['group' => $group, 'groups' => $groups, 'users' => $users, 'allUsers' => $allUsers]);
    }

    public function toggleUser(Group $group, AdminGroupToggleUser $request)
    {
        $result = $group->users()->toggle($request->validated()['user']);
        if(count($result['attached']) > 0) {
            return redirect()->back()->with('success', 'Utilisateur ajouté avec succès');
        }
        else {
            return redirect()->back()->with('success', 'Utilisateur supprimé avec succès');
        }

    }
}
