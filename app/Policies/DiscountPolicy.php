<?php

namespace App\Policies;

use App\Models\HaberDescuento;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DiscountPolicy
{
  use HandlesAuthorization;

  /**
   * Create a new policy instance.
   */
  public function viewAny(User $user): bool
  {
    return $user->can('lista descuentos');
  }

  public function view(User $user, HaberDescuento $discount): bool
  {
    return $user->can('ver descuentos');
  }

  public function create(User $user): bool
  {
    return $user->can('registrar descuentos');
  }

  public function update(User $user, HaberDescuento $discount): bool
  {
    return $user->can('editar descuentos');
  }

  public function delete(User $user, HaberDescuento $discount): bool
  {
    return $user->can('eliminar descuentos');
  }

  public function forceDelete(User $user, HaberDescuento $discount): bool
  {
    return $user->can('eliminar descuentos');
  }

  public function status(User $user, HaberDescuento $discount): bool
  {
    return $user->can('cambiar estado descuentos');
  }
}
