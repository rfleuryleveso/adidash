<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\TagTask
 *
 * @property int $id
 * @property int $tag_id
 * @property int $task_id
 * @method static \Illuminate\Database\Eloquent\Builder|TagTask newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TagTask newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TagTask query()
 * @method static \Illuminate\Database\Eloquent\Builder|TagTask whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TagTask whereTagId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TagTask whereTaskId($value)
 * @mixin \Eloquent
 */
class TagTask extends Pivot
{
    //
}
