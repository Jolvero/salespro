<?php

namespace App\Policies;

use App\Recordatorio;
use App\User;
use Facade\FlareClient\Glows\Recorder;
use Illuminate\Auth\Access\HandlesAuthorization;

class RecordatorioPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user, Recordatorio $recordatorio)
    {
        //
        if($user->rol_id != 1)
        {
            return $user->id == $recordatorio->user_id;
        }

        return $recordatorio;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Recordatorio  $recordatorio
     * @return mixed
     */
    public function view(User $user, Recordatorio $recordatorio)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    public function edit(User $user, Recordatorio $recordatorio)
    {
        if($user->rol_id != 1)
        {
            return $user->id == $recordatorio->user_id;
        }

        return $recordatorio;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Recordatorio  $recordatorio
     * @return mixed
     */
    public function update(User $user, Recordatorio $recordatorio)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Recordatorio  $recordatorio
     * @return mixed
     */
    public function delete(User $user, Recordatorio $recordatorio)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Recordatorio  $recordatorio
     * @return mixed
     */
    public function restore(User $user, Recordatorio $recordatorio)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Recordatorio  $recordatorio
     * @return mixed
     */
    public function forceDelete(User $user, Recordatorio $recordatorio)
    {
        //
    }
}
