<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\GroupProject
 *
 * @property int $id
 * @property int $group_id
 * @property int $project_id
 * @method static \Illuminate\Database\Eloquent\Builder|GroupProject newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GroupProject newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GroupProject query()
 * @method static \Illuminate\Database\Eloquent\Builder|GroupProject whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GroupProject whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GroupProject whereProjectId($value)
 * @mixin \Eloquent
 */
class GroupProject extends Pivot
{
    //
}
