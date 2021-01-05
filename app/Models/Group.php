<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use HasFactory, SoftDeletes;

    public function users()
    {
        return $this->belongsToMany(User::class)->using(GroupUser::class);
    }

    public function childs()
    {
        return $this->hasMany(Group::class, "parent_group");
    }

    public function parent()
    {
        return $this->belongsTo(Group::class, "parent_group");
    }

    /**
    * Get the projects
    */
    public function projects()
    {
        return $this->belongsToMany(Project::class)->using(GroupProject::class);
    }
}
