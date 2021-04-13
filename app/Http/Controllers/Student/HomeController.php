<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Deliverable;
use Auth;
use App\Models\Tag;
use App\Http\Resources\Tag as TagResource;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function home()
    {
        if (Auth::user()->hasStaffGroup()) {
            return redirect()->route('staff.home');
        }


        $tasks = Auth::user()->tasks();
        $tasksCount = $tasks->count();
        $waitingForDeliverable = $tasks->where('status', 'STARTED')
            ->whereNotIn('tasks.id', function ($query) {
                $query->select('deliverables.task_id')
                    ->from(with(new Deliverable)->getTable());
            })->count();
        $projets = Auth::user()->projects;
        $activeTasks = Auth::user()->tasks()->where('status', 'ACTIVE')->get();

        $startOfWeek = Carbon::now()->startOfWeek()->subWeek();
        $endOfWeek = Carbon::now()->endOfWeek()->subWeek();

        $gradesLastWeeks = Auth::user()->grades()->where('evaluation_type', 'STAFF')->where('created_at', '>', $startOfWeek)->where('created_at', '>', $endOfWeek);
        $gradesLastWeeks = $gradesLastWeeks->get();
        $gradesLastWeeks = $gradesLastWeeks->reduce(function ($carry, $grade) {
            if ($grade->grade == 1) {
                $carry['one_star'] += 1;
            } else if ($grade->grade == 2) {
                $carry['two_stars'] += 1;
            }
            return $carry;
        }, ['one_star' => 0, 'two_stars' => 0]);
        return view('student.home.home', ['tasks' => $tasks, 'tasksCount' => $tasksCount, 'waitingForDeliverable' => $waitingForDeliverable, 'projects' => $projets, 'activeTasks' => $activeTasks, 'gradesLastWeeks' => $gradesLastWeeks]);
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
