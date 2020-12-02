<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    //
    public function home()
    {
        return view('student.tasks.tasks', ['time' => time()]);
    }
}
