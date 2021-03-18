<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\ProjectUser
 *
 * @property int $id
 * @property int $user_id
 * @property int $project_id
 * @property int $relation_type 0 = Project Member, 1 = Project Client (ReadOnly), 2 = Project Moderator, 3 = Project Admin
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectUser whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectUser whereRelationType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectUser whereUserId($value)
 * @mixin \Eloquent
 */
class ProjectUser extends Pivot
{
    //
}
