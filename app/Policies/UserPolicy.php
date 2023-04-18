<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('lista usuarios');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $user2): bool
    {
        return $user->can('ver usuarios');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('registrar usuarios');
    }


    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $user2): bool
    {
        return $user->can('editar usuarios');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $user2): bool
    {
        return $user->can('eliminar usuarios');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $user2): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $user2): bool
    {
        return $user->can('eliminar usuarios');
    }

    public function status(User $user, User $user2)
    {
        return $user->can('cambiar estado usuarios');
    }
}
