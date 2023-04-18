<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run(): void
  {
    $permissions = [
      'roles' => [
        'registrar role',
        'lista de roles',
        'ver role',
        'editar role',
        'eliminar role'
      ],
      'permisos' => [
        'registrar permiso',
        'lista de permisos',
        'ver permiso',
        'editar permiso',
        'eliminar permiso',
      ],
      'usuarios' => [
        'registrar usuario',
        'lista de usuarios',
        'ver usuario',
        'editar usuario',
        'eliminar usuario',
      ],
      'personas' => [
        'registrar persona',
        'lista de personas',
        'ver persona',
        'editar persona',
        'eliminar persona',
      ],
      'descuentos' => [
        'registrar descuento',
        'lista de descuentos',
        'ver descuento',
        'editar descuento',
        'eliminar descuento',
      ],
      'haberes' => [
        'registrar haber',
        'lista de haberes',
        'ver haber',
        'editar haber',
        'eliminar haber',
      ],
      'pagos' => [
        'registrar pago',
        'lista de pagos',
        'ver pago',
        'editar pago',
        'eliminar pago',
      ],
      'importar' => [
        'importar pagos',
        'importar personas',
        'importar haberes y descuentos',
      ],
    ];

    foreach ($permissions as $group_name => $permission_names) {
      foreach ($permission_names as $permission_name) {
        Permission::create([
          'name' => $permission_name,
          'group_name' => $group_name,
          'guard_name' => 'web',
        ]);
      }
    }

    Role::create(['name' => 'Administrador']);
    Role::create(['name' => 'Tesoreria']);
    Role::create(['name' => 'Personal']);
    $user = User::first();

    $user->assignRole('Administrador');
  }
}
