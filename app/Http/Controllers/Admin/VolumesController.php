<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVolumeRequest;
use App\Http\Requests\UpdateVolumeRequest;
use App\Models\Periodo;
use App\Models\Volume;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


class VolumesController extends Controller
{
  public function __construct()
  {
    $this->authorizeResource(Volume::class, 'volume');
  }

  /**
   * Display a listing of the resource.
   */
  public function index(): View
  {

    $breadcrumbs = [
      ["link" => "/dashboard", "name" => "Home"], ["name" => "Tomos"],
    ];
    return view('admin.volumes.index', compact('breadcrumbs'));
  }

  /**
   * Show the form for creating a new resource.e
   */
  public function create(): View
  {
    $breadcrumbs = [
      ["link" => "/dashboard", "name" => "Home"],
      ["link" => "/volumes", "name" => "Tomos"],
      ["name" => "Crear"],
    ];

    $years = Periodo::orderBy('anio', 'desc')->get();
    $volume = new Volume([
      'year_id' => $years[0]->id
    ]);

    return view('admin.volumes.create', compact('breadcrumbs', 'years', 'volume'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreVolumeRequest $request): RedirectResponse
  {
    Volume::create([
      'year_id' => $request->year,
      'name' => $request->name,
    ]);

    return redirect()->route('volumes.index')->with('success', 'Registrado correctamente.');
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Volume $volume): View
  {
    $breadcrumbs = [
      ["link" => "/dashboard", "name" => "Home"],
      ["link" => "/volumes", "name" => "Tomos"],
      ["name" => "Editar"],
    ];

    $years = Periodo::orderBy('anio', 'desc')->get();

    return view('admin.volumes.edit', compact('volume', 'breadcrumbs', 'years'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateVolumeRequest $request, Volume $volume): RedirectResponse
  {

    $volume->update([
      'year_id' => $request->year,
      'name' => $request->name,
    ]);

    return redirect()->route('volumes.index')
      ->with('info', 'Cambios actualizados con éxito');
  }
}
