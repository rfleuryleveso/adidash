<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Project;

class ProjectsListComposer
{
    /**
     * The user's projects
     *
     * @var \App\Models\Project
     */
    protected $projects;

    /**
     * Create a new profile composer.
     *
     * @param  \App\Models\Project  $project
     * @return void
     */
    public function __construct(Project $projectModel)
    {
        // Dependencies automatically resolved by service container...
        $this->projects = $projectModel->all();
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('user_projects', $this->projects);
    }
}