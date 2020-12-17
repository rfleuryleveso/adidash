<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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


}
