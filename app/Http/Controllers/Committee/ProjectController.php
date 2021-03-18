<?php

namespace App\Http\Controllers\Committee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Group;
use App\Models\Project;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\Group as GroupResource;
use App\Http\Requests\CommitteeCreateProjectRequest;
use App\Notifications\ProjectAwaitingConfiguration;

class ProjectController extends CommitteeController
{

    /**
     * Displays the class list
     *
     * @return \Illuminate\Http\Response
     */
    public function projects()
    {
        $projects = parent::projectsList();
        return view('committee.projects.projects', ['projects' => $projects]);
    }

    /**
    * Displays one project
    *
    * @return \Illuminate\Http\Response
    */
    public function project(Project $project)
    {
        $team = $project->members()->withPivot('relation_type')->get();
        return view('committee.projects.project.home', ['tab' => 'home', 'project' => $project, 'team' => $team]);
    }

    /**
    * Displays one project tasks
    *
    * @return \Illuminate\Http\Response
    */
    public function project_tasks(Project $project)
    {
        $tasks = $project->tasks();
        return view('committee.projects.project.tasks', ['tab' => 'tasks', 'project' => $project, 'tasks' => $tasks]);
    }

    /**
    * Displays one project team
    *
    * @return \Illuminate\Http\Response
    */
    public function project_team(Project $project)
    {
        $team = $project->members();
        return view('committee.projects.project.team', ['tab' => 'team', 'project' => $project, 'team' => $team]);
    }


    /**
    * Creates a project
    *
    * @return \Illuminate\Http\Response
    */
    public function createProject(CommitteeCreateProjectRequest $request)
    {
        $project = new Project;
        $project->name = $request->get('name');
        $project->save();

        foreach ($request->get('groups') as $groupId) {
            // Create the relation and notify the chief
            $group = Group::find($groupId);
            $group->projects()->attach($project);
        }

        foreach ($request->get('project-chiefs') as $chiefId) {
            // Create the relation and notify the chief
            $chief = User::find($chiefId);
            $chief->ownedProjects()->attach($project, ['relation_type' => 3]);
            $chief->notify(new ProjectAwaitingConfiguration($project));
        }



        return redirect()->route('committee.project', ['project' => $project->id])->with('success', "Projet {$project->name} créer avec succès");
    }
}
