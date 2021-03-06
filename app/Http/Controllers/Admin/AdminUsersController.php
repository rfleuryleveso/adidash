<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminCreateUserRequest;
use Carbon\Carbon;
use Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class AdminUsersController extends Controller
{
    //
    public function home()
    {
        $users = User::withTrashed()->get();
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
        $user->password = Hash::make($request->password);
        $user->email_verified_at = Carbon::now();
        $user->save();
        return redirect()->route('administration.users.user.edit', ['userWithDeleted' => $user->id]);
    }

    public function deleteUser(User $user)
    {
        if ($user->is(Auth::user())) {
            return redirect()->back()->with('error', 'Vous ne pouvez pas vous supprimer vous-même');
        }
        if ($user->isAdministrator()) {
            return redirect()->back()->with('error', 'Vous ne pouvez pas supprimer un administrateur');
        }
        $user->delete();
        return redirect()->route('administration.users.home')->with('success', 'Utilisateur supprimé');
    }

    public function restore(User $user)
    {
        $user->restore();
        return redirect()->back()->with('success', 'Utilisateur restoré');
    }

    public function deleteUserPermanently(User $user)
    {
        if ($user->is(Auth::user())) {
            return redirect()->back()->with('error', 'Vous ne pouvez pas vous supprimer vous-même');
        }
        if ($user->isAdministrator()) {
            return redirect()->back()->with('error', 'Vous ne pouvez pas supprimer un administrateur');
        }
        $user->forceDelete();
        return redirect()->route('administration.users.home')->with('success', 'Utilisateur supprimé');
    }

    public function login(User $user)
    {
        $origId = Auth::id();
        Auth::login($user);
        session(['original_user' => $origId]);
        return redirect()->route('student.home')->with('success', "Connecté en tant que {$user['fullName']}");
    }
}
