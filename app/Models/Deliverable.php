<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Deliverable
 *
 * @property int $id
 * @property int $task_id
 * @property string $url
 * @property string|null $comments
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Task $task
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Deliverable newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Deliverable newQuery()
 * @method static \Illuminate\Database\Query\Builder|Deliverable onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Deliverable query()
 * @method static \Illuminate\Database\Eloquent\Builder|Deliverable whereComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deliverable whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deliverable whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deliverable whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deliverable whereTaskId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deliverable whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deliverable whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|Deliverable withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Deliverable withoutTrashed()
 * @mixin \Eloquent
 */
class Deliverable extends Model
{
    use HasFactory, SoftDeletes;

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->using(DeliverableUser::class);
    }
}
