<?php

namespace App\Policies;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('lista roles');
    }

    public function view(User $user, Role $role): bool
    {
        return $user->can('ver roles');
    }

    public function create(User $user): bool
    {
        return $user->can('registrar roles');
    }

    public function update(User $user, Role $role): bool
    {
        return $user->can('editar roles');
    }

    public function delete(User $user, Role $role): bool
    {
        return $user->can('eliminar roles');
    }

    public function forceDelete(User $user, Role $role): bool
    {
        return $user->can('eliminar roles');
    }

    public function status(User $user, Role $role): bool
    {
        return $user->can('cambiar estado roles');
    }
}
