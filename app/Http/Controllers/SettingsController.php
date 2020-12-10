<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class SettingsController extends Controller
{
    public function home()
    {
        return view('settings');
    }


}
