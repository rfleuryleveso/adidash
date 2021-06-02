<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentUpdatePasswordRequest;
use Hash;
use Illuminate\Http\Request;
use Auth;
use App\Models\Group;
use Illuminate\Validation\Rule;
use App\Models\GroupUser;
use App\Models\User;

class SettingsController extends Controller
{
    /**
     * Displays the settings page
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $availableGroups = Group::where("is_class", true)->get();
        return view('settings', ['availableGroups' => $availableGroups]);
    }

    /**
     * Updates user's settings
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $availableGroups = Group::where("is_class", true)->get();
        $availableGroupsIds = $availableGroups->map(function ($group) {
            return $group->id;
        })->all();

        $validated = $request->validate([
            'first_name' => ["required", "max:255"],
            'last_name' => ["required", "max:255"],
            'email' => ["required", "email"],
            'password' => ["required", "password"],
            'new_password' => ["filled"],
            'class_group' => ["required", "integer", Rule::in($availableGroupsIds)]
        ]);
        $forms = collect($validated);

        // Update

        $user = Auth::user();
        $user->fill($forms->only("first_name", "last_name", "email")->all());
        $user->save();

        // Update class
        if (Auth::user()->hasClassGroup()) {
            $currentClassGroup = Auth::user()->getClassGroups()->first();
            $pivotModel = GroupUser::where([
                "user_id" => Auth::id(),
                "group_id" => $currentClassGroup->id
            ])->first();
            $pivotModel->delete();
        }

        Auth::user()->groups()->attach($forms->get("class_group"));

        return redirect('settings')->with('success', 'Profil mis à jour avec succès');
    }

    /**
     * Updates user's settings
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(StudentUpdatePasswordRequest $request)
    {
        Auth::user()->password = Hash::make($request->password);
        Auth::user()->save();
        return redirect('settings')->with('success', 'Mot de passe mis à jour');
    }

    public function returnToMainAccount()
    {
        // In case the user has used the "login as" feature, make it possible to get back to it's main account
        if (session()->has('original_user')) {
            $mainAccount = User::find(session()->get('original_user'));
            session()->remove('original_user');
            Auth::login($mainAccount);
            return redirect()->route('administration.users.home')->with('success', 'Session restaurée');
        } else {
            return redirect()->back()->with('error', 'Aucun compte à restaurer');
        }
    }
}
