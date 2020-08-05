<?php

namespace App\Policies;

use App\Appointment;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AppointmentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any appointments.
     *
     * @param  \App\User  $user
     * @return mixed
     */

    public function before($user, $ability) {
        if ($user->isGranted(User::ROLE_SUPERADMIN)) {
            return true;
        }
    }
    public function viewAny(User $user)
    {
        return $user->isGranted(User::ROLE_DOCTOR);
    }

    /**
     * Determine whether the user can view the appointment.
     *
     * @param  \App\User  $user
     * @param  \App\Appointment  $appointment
     * @return mixed
     */
    public function view(User $user, Appointment $appointment)
    {
        return $user->isGranted(User::ROLE_DOCTOR) || User::ROLE_PACIENTE && $user->id === $appointment->user_id ;
    }

    /**
     * Determine whether the user can create appointments.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isGranted(User::ROLE_DOCTOR) || User::ROLE_PACIENTE;
    }

    /**
     * Determine whether the user can update the appointment.
     *
     * @param  \App\User  $user
     * @param  \App\Appointment  $appointment
     * @return mixed
     */
    public function update(User $user, Appointment $appointment)
    {
        return $user->isGranted(User::ROLE_DOCTOR) && $user->id === $appointment->user_id;
    }

    /**
     * Determine whether the user can delete the appointment.
     *
     * @param  \App\User  $user
     * @param  \App\Appointment  $appointment
     * @return mixed
     */
    public function delete(User $user, Appointment $appointment)
    {
        return $user->isGranted(User::ROLE_DOCTOR);
    }

    /**
     * Determine whether the user can restore the appointment.
     *
     * @param  \App\User  $user
     * @param  \App\Appointment  $appointment
     * @return mixed
     */
    public function restore(User $user, Appointment $appointment)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the appointment.
     *
     * @param  \App\User  $user
     * @param  \App\Appointment  $appointment
     * @return mixed
     */
    public function forceDelete(User $user, Appointment $appointment)
    {
        //
    }
}
