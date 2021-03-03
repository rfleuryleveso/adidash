<?php

namespace App\Policies;

use App\Models\Deliverable;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DeliverablePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Deliverable  $deliverable
     * @return mixed
     */
    public function view(User $user, Deliverable $deliverable)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Deliverable  $deliverable
     * @return mixed
     */
    public function update(User $user, Deliverable $deliverable)
    {
        return $deliverable
            ->users()
            ->wherePivot('level', 'CREATOR')
            ->get()
            ->contains($user);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Deliverable  $deliverable
     * @return mixed
     */
    public function delete(User $user, Deliverable $deliverable)
    {
        return $this->update($user, $deliverable);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Deliverable  $deliverable
     * @return mixed
     */
    public function restore(User $user, Deliverable $deliverable)
    {
        return $user->isAdministrator();
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Deliverable  $deliverable
     * @return mixed
     */
    public function forceDelete(User $user, Deliverable $deliverable)
    {
        return $user->isAdministrator();
    }
}
