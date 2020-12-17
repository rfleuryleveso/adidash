<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'ends_at' => 'datetime:Y-m-d',
        'ended_at' => 'datetime:Y-m-d',
    ];

    use HasFactory, SoftDeletes;

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->using(TaskUser::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->using(TaskTag::class);
    }
}
