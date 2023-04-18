<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

  public function __construct()
  {
    $this->authorizeResource(User::class, 'user');
  }

  /**
   * Display a listing of the resource.
   */
  public function index(): View
  {

    $breadcrumbs = [
      ["link" => "/dashboard", "name" => "Home"], ["name" => "Usuarios"],
    ];
    return view('admin.users.index', compact('breadcrumbs'));
  }

  /**
   * Show the form for creating a new resource.e
   */
  public function create(): View
  {
    $breadcrumbs = [
      ["link" => "/dashboard", "name" => "Home"],
      ["link" => "/users", "name" => "Usuarios"],
      ["name" => "Crear"],
    ];
    $user = new User([
      'estado' => 'activo'
    ]);
    $roles = Role::where('status', 1)->get();

    return view('admin.users.create', compact('roles', 'breadcrumbs', 'user'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreRequest $request): RedirectResponse
  {
    $user = User::create($request->all());
    $user->roles()->sync($request->get('roles'));

    return redirect()->route('users.index')->with('success', 'Registrado correctamente.');
  }

  /**
   * Display the specified resource.
   */
  public function show(User $user)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(User $user): View
  {
    $breadcrumbs = [
      ["link" => "/dashboard", "name" => "Home"],
      ["link" => "/users", "name" => "Usuarios"],
      ["name" => "Editar"],
    ];
    $roles = Role::where('status', 1)->get();

    return view('admin.users.edit', compact('user', 'roles', 'breadcrumbs'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateRequest $request, User $user): RedirectResponse
  {
    if ($request['password'] != null) {
      $user->fill(array_merge($request->except('password'), [
        'password' => bcrypt($request['password']),
      ]))->save();
    } else {
      $user->update($request->except('password'));
    }

    $user->roles()->sync($request->get('roles'));

    return redirect()->route('users.index')
      ->with('info', 'Cambios actualizados con éxito');
  }
}
