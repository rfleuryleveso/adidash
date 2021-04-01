<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Deliverable;
use Auth;
use App\Models\Tag;
use App\Http\Resources\Tag as TagResource;

class HomeController extends Controller
{
    public function home()
    {
        $tasks = Auth::user()->tasks();
        $tasksCount = $tasks->count();
        $waitingForDeliverable = $tasks->where('status', 'STARTED')
            ->whereNotIn('tasks.id', function ($query) {
                $query->select('deliverables.task_id')
                    ->from(with(new Deliverable)->getTable());
            })->count();
        $projets = Auth::user()->projects;
        $activeTasks = Auth::user()->tasks()->where('status', 'ACTIVE')->get();
        return view('student.home.home', ['tasks' => $tasks, 'tasksCount' => $tasksCount, 'waitingForDeliverable' => $waitingForDeliverable, 'projects' => $projets, 'activeTasks' => $activeTasks]);
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
