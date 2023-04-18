<?php

namespace App\Policies;

use App\Models\Pago;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentPolicy
{
  use HandlesAuthorization;

  /**
   * Create a new policy instance.
   */
  public function viewAny(User $user): bool
  {
    return $user->can('lista pagos');
  }

  public function view(User $user, Pago $payment): bool
  {
    return $user->can('ver pagos');
  }

  public function create(User $user): bool
  {
    return $user->can('registrar pagos');
  }

  public function update(User $user, Pago $payment): bool
  {
    return $user->can('editar pagos');
  }

  public function delete(User $user, Pago $payment): bool
  {
    return $user->can('eliminar pagos');
  }

  public function forceDelete(User $user, Pago $payment): bool
  {
    return $user->can('eliminar pagos');
  }

  public function status(User $user, Pago $payment): bool
  {
    return $user->can('cambiar estado pagos');
  }
}
