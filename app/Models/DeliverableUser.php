<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\DeliverableUser
 *
 * @property int $id
 * @property int $user_id
 * @property int $deliverable_id
 * @property string $level
 * @method static \Illuminate\Database\Eloquent\Builder|DeliverableUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliverableUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliverableUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliverableUser whereDeliverableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliverableUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliverableUser whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliverableUser whereUserId($value)
 * @mixin \Eloquent
 */
class DeliverableUser extends Pivot
{
    //
}
