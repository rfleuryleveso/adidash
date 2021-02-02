<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Meeting
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting query()
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Meeting extends Model
{
    use HasFactory;
}
