<?php

namespace App\Models;

use App\Models\ProjectUser;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
        'end_date' => 'datetime:Y-m-d',
        'start_date' => 'datetime:Y-m-d',
    ];

    /**
     * Get the tasks for the project.
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    /**
     * Get the members
     */
    public function members()
    {
        return $this->belongsToMany(User::class)->using(ProjectUser::class);
    }

    /**
    * Get the groups
    */
    public function groups()
    {
        return $this->belongsToMany(Group::class)->using(GroupProject::class);
    }
}
