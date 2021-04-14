<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminCreateUserRequest;
use Illuminate\Http\Request;
use App\Models\User;

class AdminUsersController extends Controller
{
    //
    public function home()
    {
        $users = User::all();
        return view('administration.users.users', ['users' => $users]);
    }

    public function edit(User $user)
    {
        return view('administration.users.user', ['user' => $user]);
    }

    public function createUserPage()
    {
        return view('administration.users.create');
    }

    public function createUser(AdminCreateUserRequest $request)
    {
        $user = new User($request->validated());
        $user->save();
        return redirect()->route('administration.users.user.edit', ['user' => $user->id]);
    }
}
