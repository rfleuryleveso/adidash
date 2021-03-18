<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\StaffSearchTasks;
use App\Http\Resources\Task as TaskResource;
use App\Http\Requests\StaffUpdateNotation;
use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Project;
use App\Models\Tag;
use App\Models\Task;
use App\Models\User;
use App\Models\GroupUser;
use Auth;

class StaffStudentsController extends Controller
{
    public function home(User $user, GroupUser $groupUser)
    {
        return view('staff.students.students', ['user' => $user]);
    }
}