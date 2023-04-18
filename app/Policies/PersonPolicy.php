<?php

namespace App\Policies;

use App\Models\Persona;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PersonPolicy
{
  use HandlesAuthorization;

  /**
   * Create a new policy instance.
   */
  public function viewAny(User $user): bool
  {
    return $user->can('lista personas');
  }

  public function view(User $user, Persona $person): bool
  {
    return $user->can('ver personas');
  }

  public function create(User $user): bool
  {
    return $user->can('registrar personas');
  }

  public function update(User $user, Persona $person): bool
  {
    return $user->can('editar personas');
  }

  public function delete(User $user, Persona $person): bool
  {
    return $user->can('eliminar personas');
  }

  public function forceDelete(User $user, Persona $person): bool
  {
    return $user->can('eliminar personas');
  }

  public function status(User $user, Persona $person): bool
  {
    return $user->can('cambiar estado personas');
  }
}
