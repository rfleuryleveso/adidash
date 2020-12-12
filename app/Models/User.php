<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    
    /**
     * Get the user's groups
     *
     * @return [Group]
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    /**
     * Get the user's tasks
     * 
     * @return [Task]
     */
    public function tasks()
    {
        return $this->belongsToMany('App\Models\Task')->using('App\Models\TaskRole');
    }

    /**
     * Helper functions for groups
     */
    
    /**
     * Get the user's classgroup
     * 
     * @return Group
     */
    public function getClassGroup() {
        return $this->groups()->where('is_class', true)->first();
    }

    /**
     * Check if the user has a class group
     * 
     * @return Boolean
     */
    public function hasClassGroup() {
        return $this->getClassGroup() != null;
    }

    /**
     * Get the user's comity group
     * 
     * @return Group
     */
    public function getComityGroup() {
        return $this->groups()->where('rank', 2)->first();
    }

    /**
     * Check if the user has a comity group
     * 
     * @return Boolean
     */
    public function hasComityGroup() {
        return $this->getComityGroup() != null;
    }
}
