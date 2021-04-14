<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\StaffSearchTasks;
use App\Http\Resources\Task as TaskResource;
use App\Http\Requests\StaffUpdateNotation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Project;
use App\Models\Tag;
use App\Models\Task;
use App\Models\User;
use App\Models\GroupUser;
use Auth;
use DB;

class StaffStudentsController extends Controller
{
    public function home()
    {
        $users = User::paginate(100);
        return view('staff.students.students', ['users' => $users]);
    }

    public function student(User $user)
    {
        $tasksQuery = $user->tasks()->where('status', 'FINISHED')->orderBy('ended_at');
        $tasks = $tasksQuery->get();
        $tasksPerWeekLabels = [];
        $tasksPerWeekValues = [];

        if ($tasks->count() > 0) {
            // First grade ever
            $firstTask = $tasks->first();
            $weeks = (new Carbon($firstTask->ended_at->startOfWeek()))->diffInWeeks(null, true);
            $date = Carbon::now()->subtract('week', $weeks)->startOfWeek();

            for ($i = 0; $i < $weeks + 1; $i++) {
                $weekStart = $date->clone()->add('weeks', $i)->startOfWeek();
                $tasksPerWeekLabels[$i] = $weekStart->toDateString();
                $tasksThisWeekQuery = $user->tasks()->where('status', 'FINISHED')->where([
                    ['ended_at', '>=', $weekStart->toDateTimeString()],
                    ['ended_at', '<=', $weekStart->clone()->endOfWeek()->toDateTimeString()]
                ]);
                $tasksPerWeekValues[$i] = $tasksThisWeekQuery->clone()->count();

            }
        }

        $projects = $user->projects()->withPivot('relation_type')->get();
        $tasks = Auth::user()->tasks;
        return view('staff.students.student', ['user' => $user, 'tasksPerWeekLabels' => $tasksPerWeekLabels, 'tasksPerWeekValues' => $tasksPerWeekValues, 'projects' => $projects, 'tasks' => $tasks]);
    }


}
