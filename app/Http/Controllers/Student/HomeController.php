<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Auth;

class HomeController extends Controller {
	public function home() {
		return view('student.home.home');
	}

	public function logout() {
		Auth::Logout();
		return redirect('/');
	}

}
