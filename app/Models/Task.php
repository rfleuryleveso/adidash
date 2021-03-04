<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Task
 *
 * @property int $id
 * @property int $project_id
 * @property string $name
 * @property string $description
 * @property int|null $parent_task
 * @property string $status
 * @property string $notation_status
 * @property \datetime|null $starts_at
 * @property \datetime|null $ended_at
 * @property \datetime|null $ends_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Deliverable[] $deliverables
 * @property-read int|null $deliverables_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Grade[] $grades
 * @property-read int|null $grades_count
 * @property-read Task|null $parent
 * @property-read \App\Models\Project $project
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @property-read int|null $tags_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static Builder|Task newModelQuery()
 * @method static Builder|Task newQuery()
 * @method static \Illuminate\Database\Query\Builder|Task onlyTrashed()
 * @method static Builder|Task query()
 * @method static Builder|Task whereCreatedAt($value)
 * @method static Builder|Task whereDeletedAt($value)
 * @method static Builder|Task whereDescription($value)
 * @method static Builder|Task whereEndedAt($value)
 * @method static Builder|Task whereEndsAt($value)
 * @method static Builder|Task whereId($value)
 * @method static Builder|Task whereName($value)
 * @method static Builder|Task whereNotationStatus($value)
 * @method static Builder|Task whereParentTask($value)
 * @method static Builder|Task whereProjectId($value)
 * @method static Builder|Task whereStartsAt($value)
 * @method static Builder|Task whereStatus($value)
 * @method static Builder|Task whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Task withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Task withoutTrashed()
 * @mixin \Eloquent
 */
class Task extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'starts_at', 'ends_at', 'started_at', 'parent_task'];


    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'ends_at' => 'datetime:Y-m-d',
        'ended_at' => 'datetime:Y-m-d',
        'starts_at' => 'datetime:Y-m-d'
    ];
    use HasFactory, SoftDeletes;

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function parent()
    {
        return $this->belongsTo(Task::class, "parent_task");
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->using(TaskUser::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->using(TagTask::class);
    }

    public function deliverables()
    {
        return $this->hasMany(Deliverable::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    /**
     * Scope a query to only include active users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAvailable($query)
    {
        return $query->whereIn('status', ['WAITING', 'STARTED']);
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
    }
}
