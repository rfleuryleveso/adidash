<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Task extends Model
{
    use HasFactory, SoftDeletes;

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    public function users()
    {
        return $this->hasMany('App\Models\User')->using('App\Models\TaskUser');
    }
}
