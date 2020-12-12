<?php

namespace App\Http\Controllers\ProjectAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Project;
use Illuminate\Support\Facades\Gate;

class ProjectAdminController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request, Project $project)
    {
        
    }

    public function home(Project $project)
    {
        return view('project-admin.index', ['project'=>$project]);
    }
}
