<?php

namespace App\Policies;

use App\Specialty;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SpecialtyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any specialties.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {

    }

    /**
     * Determine whether the user can view the specialty.
     *
     * @param  \App\User  $user
     * @param  \App\Specialty  $specialty
     * @return mixed
     */
    public function view(User $user, Specialty $specialty)
    {
        //
    }

    /**
     * Determine whether the user can create specialties.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isGranted(User::ROLE_SUPERADMIN);
    }

    /**
     * Determine whether the user can update the specialty.
     *
     * @param  \App\User  $user
     * @param  \App\Specialty  $specialty
     * @return mixed
     */
    public function update(User $user, Specialty $specialty)
    {
        return $user->isGranted(User::ROLE_SUPERADMIN);
    }

    /**
     * Determine whether the user can delete the specialty.
     *
     * @param  \App\User  $user
     * @param  \App\Specialty  $specialty
     * @return mixed
     */
    public function delete(User $user, Specialty $specialty)
    {
        return $user->isGranted(User::ROLE_SUPERADMIN);
    }

    /**
     * Determine whether the user can restore the specialty.
     *
     * @param  \App\User  $user
     * @param  \App\Specialty  $specialty
     * @return mixed
     */
    public function restore(User $user, Specialty $specialty)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the specialty.
     *
     * @param  \App\User  $user
     * @param  \App\Specialty  $specialty
     * @return mixed
     */
    public function forceDelete(User $user, Specialty $specialty)
    {
        //
    }
}
