<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function show()
    {
        return view('welcome', ['time' => time()]);
    }

    public function timesheets()
    {
        
        return view('timesheets', ['time' => time()]);
    }
}
