<?php

namespace App\Services;

class MenuService
{
  public static function getMenus()
  {
    $menus = array(
      'dashboard' => [
        'icon' => 'heroicon-o-home',
        'title' => 'Dashboard',
        'model' => '',
        'route' => 'dashboard',
        'can' => '',
      ],
      'users' => [
        'icon' => 'feathericon-users',
        'title' => 'Usuarios',
        'model' => 'Models\User',
        'route' => 'users.index',
        'can' => 'viewAny',
      ],
      'people' => [
        'icon' => 'feathericon-user-check',
        'title' => 'Personas',
        'model' => 'Models\Persona',
        'route' => 'people.index',
        'can' => 'viewAny',
      ],
      'roles' => [
        'icon' => 'feathericon-shield',
        'title' => 'Roles',
        'model' => 'Spatie\Permission\Models\Role',
        'route' => 'roles.index',
        'can' => 'viewAny',
      ],
      'discounts' => [
        'icon' => 'feathericon-minus',
        'title' => 'Descuentos',
        'model' => 'Models\HaberDescuento',
        'route' => 'discounts.index',
        'can' => 'viewAny',
      ],
      'assets' => [
        'icon' => 'feathericon-plus',
        'title' => 'Haberes',
        'model' => 'Models\HaberDescuento',
        'route' => 'assets.index',
        'can' => 'viewAny',
      ],
      'payments' => [
        'icon' => 'feathericon-credit-card',
        'title' => 'Pagos',
        'model' => 'Models\Pago',
        'route' => 'payments.index',
        'can' => 'viewAny',
      ],
      'volumes' => [
        'icon' => 'feathericon-folder',
        'title' => 'Tomos',
        'model' => 'Models\Volume',
        'route' => 'volumes.index',
        'can' => 'viewAny',
      ],
      'forms' => [
        'icon' => 'feathericon-file',
        'title' => 'Planillas',
        'model' => 'Models\Form',
        'route' => 'forms.index',
        'can' => 'viewAny',
      ],
      'imports' => [
        'icon' => 'feathericon-upload',
        'title' => 'Importar',
        'model' => 'Models\Persona',
        'route' => 'imports',
        'can' => 'viewAny',
        'sub_menu' => [
          'payments-import' => [
            'icon' => '',
            'route' => 'imports.payments',
            'title' => 'Cargar Pagos',
            'model' => 'Models\Pago',
            'can' => 'create',
          ],
          'people-import' => [
            'icon' => '',
            'route' => 'imports.people',
            'title' => 'Cargar Personas',
            'model' => 'Models\Persona',
            'can' => 'viewAny',
          ],
          'judicials-import' => [
            'icon' => '',
            'route' => 'imports.judicials',
            'title' => 'Cargar Judiciales',
            'model' => 'Models\Judicials',
            'can' => 'viewAny',
          ],
        ],
      ],
      'reports' => [
        'icon' => 'feathericon-file-text',
        'title' => 'Reporte',
        'model' => 'Models\Persona',
        'route' => 'reports',
        'can' => 'viewAny',
        'sub_menu' => [
          'year-report' => [
            'icon' => '',
            'route' => 'reports.year',
            'title' => 'Reporte Por Año',
            'model' => 'Models\Pago',
            'can' => 'viewAny',
          ],
          'years-report' => [
            'icon' => '',
            'route' => 'reports.years',
            'title' => 'Reporte Por Años',
            'model' => 'Models\Pago',
            'can' => 'viewAny',
          ],
          'api-month-report' => [
            'icon' => '',
            'route' => 'reports.voucher',
            'title' => 'Reporte Boleta de Pago',
            'model' => 'Models\Pago',
            'can' => 'viewAny',
          ],
          'judicials-report' => [
            'icon' => '',
            'route' => 'reports.judicials',
            'title' => 'Reporte Judiciales',
            'model' => 'Models\Judicial',
            'can' => 'viewAny',
          ],
        ],
      ],

      // 'devider',

      // 'leave_types' => [
      //     'icon' => 'heroicon-o-document-duplicate',
      //     'title' => 'Tipo de Papeletas',
      //     'model' => 'Models\LeaveType',
      //     'route' => 'leave_types.index',
      //     'can' => 'viewAny',
      // ],

    );
    return $menus;
  }
}
