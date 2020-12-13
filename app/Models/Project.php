<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Task;
use App\Models\User;
use App\Models\ProjectUser;

class Project extends Model
{
    use HasFactory, SoftDeletes;

/**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'ends_at' => 'datetime:Y-m-d',
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
    
}
