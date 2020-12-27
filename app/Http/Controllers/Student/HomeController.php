<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Auth;
use App\Models\Tag;
use App\Http\Resources\Tag as TagResource;

class HomeController extends Controller
{
    public function home()
    {
        return view('student.home.home');
    }

    public function logout()
    {
        Auth::Logout();
        return redirect('/');
    }

    public function tags()
    {
        $tags = Tag::all();
        return TagResource::collection($tags);
    }
}
