<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Deliverable[] $deliverables
 * @property-read int|null $deliverables_count
 * @property-read string $full_name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Group[] $groups
 * @property-read int|null $groups_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Project[] $projects
 * @property-read int|null $projects_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Task[] $tasks
 * @property-read int|null $tasks_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password'
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
     * Get the user's grades
     *
     * @return [Grade]
     */
    public function grades()
    {
        return $this->hasMany(Grade::class, 'user_id');
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
     * Get the user's administration group
     *
     * @return Group
     */
    public function getAdministrationGroups()
    {
        return $this->groups()->where('rank', 4);
    }

    /**
     * Check if the user has an administration group
     *
     * @return Boolean
     */
    public function hasAdministrationGroup()
    {
        return $this->getAdministrationGroups()->first() != null;
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
