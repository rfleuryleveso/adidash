<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectUser;
use Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Auth::user()->groups;
        return view("student.projects.index", ["groups" => $groups]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $available_tasks = $project->tasks()->whereIn('status', ['WAITING', 'STARTED'])->get();
        return view("student.projects.project", ["project" => $project, "available_tasks" => $available_tasks]);
    }


    /**
     * Join a project and attach the user to it's members
     * @param Project $project
     * @return \Illuminate\Http\RedirectResponse
     */
    public function join(Project $project)
    {
        if ($project->members->contains(Auth::user())) {
            return redirect()->back()->with('success', 'Vous faites déja partie de ce projet');
        }
        if ($project->allow_new_member == false) {
            return redirect()->back()->with('error', 'Ce projet n\'accepte pas de nouveau membres');
        }
        $project->members()->attach(Auth::id(), ['relation_type' => 0]);
        return redirect()->back()->with('success', 'Vous avez rejoint ce projet');
    }

    public function leave(Project $project)
    {
        $projectMember = ProjectUser::where([['user_id', Auth::id()], ['project_id', $project->id]])->first();
        if (!$projectMember) {
            return redirect()->back()->with('error', 'Vous ne faites pas partie de ce projet, vous ne pouvez donc pas le quitter');
        }
        if ($projectMember->relation_type > 0) {
            return redirect()->back()->with('error', 'Vous êtes un membre important de ce projet, vous ne pouvez donc pas le quitter');
        } else {
            $project->members()->detach(Auth::id());
            return redirect()->back()->with('success', 'Vous avez quitté ce projet');
        }

    }
}
