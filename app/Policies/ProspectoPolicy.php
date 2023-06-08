<?php

namespace App\Policies;

use App\Prospecto;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProspectoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user, Prospecto $prospecto)
    {
        //
        if($user->rol_id != null)
        {
            return $prospecto;
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Prospecto  $prospecto
     * @return mixed
     */
    public function view(User $user, Prospecto $prospecto)
    {
        //

        if($user->rol_id != 1)
        {
            return $user->id == $prospecto->user_id;

        }

        return $prospecto;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user, Prospecto $prospecto)
    {
        //

    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Prospecto  $prospecto
     * @return mixed
     */
    public function update(User $user, Prospecto $prospecto)
    {
        //
    }

    public function edit(User $user, Prospecto $prospecto)
    {
        //
        if($user->rol_id !=1)
        {
            return $user->id == $prospecto->user_id;

        }
        return $prospecto;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Prospecto  $prospecto
     * @return mixed
     */
    public function delete(User $user, Prospecto $prospecto)
    {
        //

        if($user->rol_id !=1)
        {
            return $user->id == $prospecto->user_id;
        }

        return $prospecto;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Prospecto  $prospecto
     * @return mixed
     */
    public function restore(User $user, Prospecto $prospecto)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Prospecto  $prospecto
     * @return mixed
     */
    public function forceDelete(User $user, Prospecto $prospecto)
    {
        //
    }
}
