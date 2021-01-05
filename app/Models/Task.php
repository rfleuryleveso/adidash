<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Builder;

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

    /**
    * The "booted" method of the model.
    *
    * @return void
    */
    protected static function booted()
    {
        static::addGlobalScope('available', function (Builder $builder) {
            $builder->where(function ($query) {
                $query->where('starts_at', '<', now())->orWhereNull('starts_at');
            })
            ->whereNotIn('status', ['WAITING_FOR_PARENT_TASK', 'FINISHED', 'CANCELLED']);
        });
    }
}
