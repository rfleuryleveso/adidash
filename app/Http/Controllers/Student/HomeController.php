<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class HomeController extends Controller
{
    public function home()
    {
        return view('student.home.home', ['time' => time()]);
    }

    public function logout()
    {
        Auth::Logout();
        return redirect('/');
    }

}
