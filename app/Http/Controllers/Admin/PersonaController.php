<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PersonaCreatedRequest;
use App\Models\Persona;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PersonaController extends Controller
{

  public function __construct()
  {
    $this->authorizeResource(Persona::class, 'person');
  }

  public function search(Request $request): JsonResponse
  {
    $this->authorize('viewAny', Persona::class);
    $personas = Persona::where('estado', request('estado'))
      ->search(request('q', ''))
      ->orderBy('apellido_paterno', 'DESC')->take(5)->get();

    return response()->json(['personas' => $personas], 200);
  }

  public function nose(Request $request): JsonResponse
  {
    $estado = $request->get('estado') ?? $request->get('estado');

    $personas = Persona::where('estado', $estado)
      ->search(request('search', ''))
      ->paginate(request('perPage', 10));

    return response()->json($personas, 200);
  }

  public function index(): View
  {
    $breadcrumbs = [
      ["link" => "/dashboard", "name" => "Home"], ["name" => "Personas"]
    ];

    return view('admin.people.index', ['breadcrumbs' => $breadcrumbs]);
  }

  public function create(): View
  {
    $breadcrumbs = [
      ["link" => "/dashboard", "name" => "Home"],
      ["link" => "/admin/people", "name" => "Personas"],
      ["name" => "Crear"]
    ];

    $person = new Persona([
      'estado' => 'activo'
    ]);

    return view('admin.people.create', compact('breadcrumbs', 'person'));
  }


  public function store(PersonaCreatedRequest $request)
  {
    $persona = new Persona();
    $persona->nombre = $request->nombre;
    $persona->apellido_paterno = $request->apellido_paterno;
    $persona->apellido_materno = $request->apellido_materno;
    $persona->dni = $request->dni;
    $persona->codigo_modular = $request->codigo_modular;
    $persona->cargo = $request->cargo;
    $persona->estado = $request->estado;
    $persona->user_id = Auth::id();

    if ($persona->save()) {
      return redirect()->route('people.index')->with('success', 'Registrado correctamente.');
    }
  }

  public function edit(Persona $person): View
  {
    $breadcrumbs = [
      ["link" => "/dashboard", "name" => "Home"],
      ["link" => "/admin/people", "name" => "Personas"],
      ["name" => "Editar"]
    ];

    return view('admin.people.edit', compact('breadcrumbs', 'person'));
  }

  public function update(PersonaCreatedRequest $request, $id)
  {
    $persona = Persona::findOrFail($id);
    $persona->nombre = $request->nombre;
    $persona->apellido_paterno = $request->apellido_paterno;
    $persona->apellido_materno = $request->apellido_materno;
    $persona->dni = $request->dni;
    $persona->codigo_modular = $request->codigo_modular;
    $persona->cargo = $request->cargo;
    $persona->estado = $request->estado;
    $persona->user_id = Auth::id();

    if ($persona->save()) {
      return redirect()->route('people.index')->with('success', 'Editado correctamente.');
    }
  }
}
