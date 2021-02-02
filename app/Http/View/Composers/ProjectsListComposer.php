<?php

namespace App\Http\View\Composers;

use App\Models\Project;
use Illuminate\View\View;

class ProjectsListComposer
{
    /**
     * The user's projects
     *
     * @var Project
     */
    protected $projects;

    /**
     * Create a new profile composer.
     *
     * @param Project $project
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
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('user_projects', $this->projects);
    }
}
