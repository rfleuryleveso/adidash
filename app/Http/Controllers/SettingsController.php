<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class SettingsController extends Controller
{
    /**
     * Displays the settings page
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return view('settings');
    }

    /**
     * Updates user's settings
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ["required", "max:255"],
            'last_name' => ["required", "max:255"],
            'email' => ["required", "email"],
        ]);
        $user = Auth::user();
        $user->fill($validated);
        $user->save();
        return redirect('settings')->with('success', 'Profile mis à jour avec succès');
    }
}
