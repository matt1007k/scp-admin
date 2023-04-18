<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HaberCreatedRequest;
use App\Http\Requests\HaberUpdatedRequest;
use App\Models\HaberDescuento;
use Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HaberController extends Controller
{
  public function __contruct()
  {
    $this->authorizeResource(HaberDescuento::class, 'assets');
  }
  public function search()
  {
    $es_imponible = request('imponible') ?? request('imponible');
    $haberes = HaberDescuento::orderBy('nombre', 'DESC')
      ->where('es_imponible', $es_imponible)
      ->search(request('q'))
      ->get();

    return response()->json(['haberes' => $haberes], 200);
  }

  public function inded(Request $request)
  {
    $es_imponible = request('imponible') ?? request('imponible');
    $haberes = HaberDescuento::where('tipo', 'haber')
      ->search(request('search', ''))
      ->paginate(request('perPage', 10));
    if ($es_imponible !== 'Todos') {
      $haberes = HaberDescuento::where('tipo', 'haber')
        ->where('es_imponible', $es_imponible)
        ->search(request('search', ''))
        ->paginate(request('perPage', 10));
    }

    return response()->json($haberes, 200);
  }

  public function index(): View
  {
    $breadcrumbs = [
      ["link" => "/dashboard", "name" => "Home"],
      ["name" => "Haberes"]
    ];
    return view('admin.assets.index', compact('breadcrumbs'));
  }

  public function create(): View
  {
    $breadcrumbs = [
      ["link" => "/dashboard", "name" => "Home"],
      ["link" => "/admin/assets", "name" => "Haberes"],
      ["name" => "Crear"]
    ];
    $asset = new HaberDescuento([
      'tipo' => 'haber',
      'es_imponible' => 0
    ]);
    return view('admin.assets.create', compact('breadcrumbs', 'asset'));
  }

  public function store(HaberCreatedRequest $request)
  {
    HaberDescuento::create(array_merge($request->all(), [
      'tipo' => 'haber',
      'user_id' => Auth::id()
    ]));

    return redirect()->route('assets.index')->with('success', 'Registrado correctamente.');
  }

  public function edit(HaberDescuento $asset): View
  {
    $breadcrumbs = [
      ["link" => "/dashboard", "name" => "Home"],
      ["link" => "/admin/assets", "name" => "Haberes"],
      ["name" => "Editar"]
    ];
    return view('admin.assets.edit', compact('breadcrumbs', 'asset'));
  }

  public function update(HaberUpdatedRequest $request, HaberDescuento $asset)
  {
    $asset->update($request->all());

    return redirect()->route('assets.index')->with('success', 'Editado correctamente.');
  }
}
