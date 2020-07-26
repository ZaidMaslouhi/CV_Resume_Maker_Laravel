<?php

namespace App\Policies;

use App\Cv;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CvPolicy
{
    use HandlesAuthorization;

    // Give all rights to the administrator except the deleting action
    public function before($user, $ability){
        if($user->is_admin and $ability != 'delete')
            return true;
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Cv  $cv
     * @return mixed
     */
    public function view(User $user, Cv $cv)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Cv  $cv
     * @return mixed
     */
    public function update(User $user, Cv $cv)
    {
        return $user->id == $cv->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Cv  $cv
     * @return mixed
     */
    public function delete(User $user, Cv $cv)
    {
        return $user->id == $cv->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Cv  $cv
     * @return mixed
     */
    public function restore(User $user, Cv $cv)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Cv  $cv
     * @return mixed
     */
    public function forceDelete(User $user, Cv $cv)
    {
        //
    }
}
