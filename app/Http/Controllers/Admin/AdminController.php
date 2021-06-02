<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deliverable;
use App\Models\Grade;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    //
    public function home()
    {
        $users = User::count();
        $tasks = Task::count();
        $grades = Grade::count();
        $projects = Project::count();
        $deliverables = Deliverable::count();
        return view('administration.home', ['users' => $users, 'tasks' => $tasks, 'grades' => $grades, 'projects' => $projects, 'deliverables' => $deliverables]);
    }
}
