<?php

namespace App\Policies;

use App\Models\HaberDescuento;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AssetPolicy
{
  use HandlesAuthorization;

  /**
   * Create a new policy instance.
   */
  public function viewAny(User $user): bool
  {
    return $user->can('lista haberes');
  }

  public function view(User $user, HaberDescuento $asset): bool
  {
    return $user->can('ver haberes');
  }

  public function create(User $user): bool
  {
    return $user->can('registrar haberes');
  }

  public function update(User $user, HaberDescuento $asset): bool
  {
    return $user->can('editar haberes');
  }

  public function delete(User $user, HaberDescuento $asset): bool
  {
    return $user->can('eliminar haberes');
  }

  public function forceDelete(User $user, HaberDescuento $asset): bool
  {
    return $user->can('eliminar haberes');
  }

  public function status(User $user, HaberDescuento $asset): bool
  {
    return $user->can('cambiar estado haberes');
  }
}
