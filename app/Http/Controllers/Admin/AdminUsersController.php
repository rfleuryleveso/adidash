<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
}
