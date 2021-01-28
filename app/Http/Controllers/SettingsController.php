<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Group;
use Illuminate\Validation\Rule;
use App\Models\GroupUser;

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
     * @param  \Illuminate\Http\Request  $request
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
}
