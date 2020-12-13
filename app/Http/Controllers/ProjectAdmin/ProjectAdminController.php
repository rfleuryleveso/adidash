<?php

namespace App\Http\Controllers\ProjectAdmin;

use App\Http\Controllers\Controller;
use App\Models\Project;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;

use \Carbon\Carbon;

class ProjectAdminController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
    }

    public function home(Project $project)
    {
        $week_start = \Carbon\Carbon::now()->previous(Carbon::MONDAY);
        $week_end = $week_start->copy()->next(Carbon::SUNDAY); // Generate bounds

        $week_tasks = $project->tasks()
        ->where(
            [
            ['ends_at', '>=', $week_start],
            ['ends_at', '<=', $week_end]
        ]
        )->orWhere(
            [
            ['ended_at', '>=', $week_start],
            ['ended_at', '<=', $week_end]
        ]
        )->get();
        // Check for tasks within the bounds

        return view('project-admin.index', ['project'=>$project, 'week_tasks' => $week_tasks]);
    }
}
