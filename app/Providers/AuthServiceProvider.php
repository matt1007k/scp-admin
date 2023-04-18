<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
  /**
   * The model to policy mappings for the application.
   *
   * @var array<class-string, class-string>
   */
  protected $policies = [
    // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    'Spatie\Permission\Models\Role' => 'App\Policies\RolePolicy',
    'Models\User' => 'App\Policies\UserPolicy',
    'Models\HaberDescuento' => 'App\Policies\AssetPolicy',
    'Models\HaberDescuento' => 'App\Policies\DiscountPolicy',
    'Models\Persona' => 'App\Policies\PersonPolicy',
    'Models\Pago' => 'App\Policies\PaymentPolicy',
  ];

  /**
   * Register any authentication / authorization services.
   */
  public function boot(): void
  {
    $this->registerPolicies();

    Gate::before(function (User $user, $ability) {
      if ($user->hasRole('Administrador')) return true;
    });
  }
}
