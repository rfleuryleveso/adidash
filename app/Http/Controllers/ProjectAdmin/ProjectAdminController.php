<?php

namespace App\Http\Controllers\ProjectAdmin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use \Carbon\Carbon;

use App\Http\Requests\ProjectUpdate;

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
        $finished_tasks = $project->tasks()
            ->where(
                [
                    ['status', 'FINISHED'],
                    ['notation_status', 'WAITING_FOR_CHIEF']
                ]
            )->get();
        // Check for tasks within the bounds

        $members = $project->members()->withPivot('relation_type')->get();
        $tasksIds = $project->tasks()->pluck('id')->all();
        return view('project-admin.index', ['project' => $project, 'members' => $members, 'tasksIds' => $tasksIds, 'finished_tasks' => $finished_tasks]);
    }

    public function update(ProjectUpdate $request, Project $project)
    {
        $project->update($request->validated());
        $project->save();
        return redirect()->back()->with('success', 'Projet mis à jour avec succès');
    }
}
