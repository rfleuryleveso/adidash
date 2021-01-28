<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use DB;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Get the user's groups
     *
     * @return [Group]
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class)->using(GroupUser::class);
    }

    /**
     * Get the user's tasks
     *
     * @return [Task]
     */
    public function tasks()
    {
        return $this->belongsToMany(Task::class)->using(TaskUser::class);
    }

    /**
     * Get the project by relation
     *
     * @return [Project]
     */
    public function projects()
    {
        return $this->belongsToMany(Project::class)->using(ProjectUser::class);
    }

    /**
     * Get the user's directed projects
     *
     * @return [Project]
     */
    public function ownedProjects()
    {
        return $this->projects()->wherePivot('relation_type', '>=', 2);
    }

    /**
     * Get the user's deliverables
     *
     * @return [Task]
     */
    public function deliverables()
    {
        return $this->belongsToMany(Deliverable::class)->using(DeliverableUser::class);
    }

    /**
     * Helper functions for groups
     */

    /**
     * Get the user's classgroups
     * More likely to be only one.
     *
     * @return Group
     */
    public function getClassGroups()
    {
        return $this->groups()->where('is_class', true);
    }

    /**
     * Check if the user has a class group
     *
     * @return Boolean
     */
    public function hasClassGroup()
    {
        return $this->getClassGroups()->first() != null;
    }

    /**
     * Get the user's classgroup
     *
     * @return String
     */
    public function getClassGroupName()
    {
        $classGroup = $this->getClassGroups()->first();
        if ($classGroup) {
            return $classGroup->name;
        } else {
            return "N/A";
        }
    }

    /**
     * Get the user's committee group
     *
     * @return Group
     */
    public function getCommitteeGroups()
    {
        return $this->groups()->where('rank', 2);
    }

    /**
     * Check if the user has a committee group
     *
     * @return Boolean
     */
    public function hasCommitteeGroup()
    {
        return $this->getCommitteeGroups()->first() != null;
    }

    /**
     * Get the user's staff groups
     *
     * @return Group
     */
    public function getStaffGroups()
    {
        return $this->groups()->where('rank', 3);
    }

    /**
     * Check if the user has a staff group
     *
     * @return Boolean
     */
    public function hasStaffGroup()
    {
        return $this->getStaffGroups()->first() != null;
    }
    
    /**
     * Checks if the user is an administrator.
     * Currently unused
     *
     * @return Boolean
     */
    public function isAdministrator()
    {
        return false;
    }
}
