<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Grade
 *
 * @property int $id
 * @property int $task_id
 * @property int $user_id
 * @property int $evaluator_id
 * @property string $evaluation_type
 * @property int $grade
 * @property string $comments
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $evaluator
 * @property-read Task $task
 * @property-read User $user
 * @method static Builder|Grade newModelQuery()
 * @method static Builder|Grade newQuery()
 * @method static Builder|Grade query()
 * @method static Builder|Grade whereComments($value)
 * @method static Builder|Grade whereCreatedAt($value)
 * @method static Builder|Grade whereEvaluationType($value)
 * @method static Builder|Grade whereEvaluatorId($value)
 * @method static Builder|Grade whereGrade($value)
 * @method static Builder|Grade whereId($value)
 * @method static Builder|Grade whereTaskId($value)
 * @method static Builder|Grade whereUpdatedAt($value)
 * @method static Builder|Grade whereUserId($value)
 * @mixin Eloquent
 */
class Grade extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'task_id', 'evaluator_id', 'grade', 'comments'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function evaluator()
    {
        return $this->belongsTo(User::class, 'evaluator_id');
    }
}
