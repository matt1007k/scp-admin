<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use App\Http\Requests\Role\StoreRequest;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\Role\UpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RoleController extends Controller
{
  /**
   * Display a listing of the resource.
   */

  public function __construct()
  {
    $this->authorizeResource(Role::class, 'role');
  }

  public function index(): View
  {
    $breadcrumbs = [
      ["link" => "/dashboard", "name" => "Home"], ["name" => "Roles"]
    ];

    return view('admin.roles.index', ['breadcrumbs' => $breadcrumbs]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(): View
  {
    $breadcrumbs = [
      ["link" => "/dashboard", "name" => "Home"],
      ["link" => "/admin/roles", "name" => "Roles"],
      ["name" => "Crear"]
    ];

    $permissions_group = Permission::all()->groupBy('group_name');
    $role = new Role([
      'status' => 1
    ]);

    return view('admin.roles.create', compact('permissions_group', 'breadcrumbs', 'role'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreRequest $request): RedirectResponse
  {
    $role = Role::create($request->only('name', 'status'));
    if ($request->has('permissions')) $role->syncPermissions($request->permissions);

    return redirect()->route('roles.index')->with('success', 'Registrado correctamente.');
  }

  /**
   * Display the specified resource.
   */
  public function show(Role $role): View
  {
    $breadcrumbs = [
      ["link" => "/dashboard", "name" => "Home"],
      ["link" => "/admin/roles", "name" => "Roles"],
      ["name" => "Ver"]
    ];

    return view('admin.roles.show', compact('role', 'breadcrumbs'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Role $role): View
  {

    $breadcrumbs = [
      ["link" => "/dashboard", "name" => "Home"],
      ["link" => "/admin/roles", "name" => "Roles"],
      ["name" => "Editar"]
    ];
    $permissions_group = Permission::all()->groupBy('group_name');
    return view('admin.roles.edit', compact('role', 'permissions_group', 'breadcrumbs'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateRequest $request, Role $role): RedirectResponse
  {
    $role->update($request->only('name', 'status'));

    if ($request->has('permissions')) $role->syncPermissions($request->permissions);


    return redirect()->route('roles.index')
      ->with('info', 'Cambios actualizados con éxito');
  }
}
