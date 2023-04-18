<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DescuentoCreatedRequest;
use App\Http\Requests\DescuentoUpdatedRequest;
use App\Models\HaberDescuento;
use Auth;
use Illuminate\View\View;

class DescuentoController extends Controller
{
  public function __construct()
  {
    $this->authorizeResource(HaberDescuento::class, 'discount');
  }

  public function search()
  {
    $tipo = request('tipo') ?? request('tipo');
    $descuentos = HaberDescuento::orderBy('nombre', 'DESC')
      ->where('tipo', $tipo)
      ->search(request('q'))
      ->take(5)
      ->get();

    return response()->json(['descuentos' => $descuentos], 200);
  }

  public function index(): View
  {
    $breadcrumbs = [
      ["link" => "/dashboard", "name" => "Home"],
      ["name" => "Descuentos"]
    ];
    return view('admin.discounts.index', compact('breadcrumbs'));
  }

  public function create(): View
  {
    $breadcrumbs = [
      ["link" => "/dashboard", "name" => "Home"],
      ["link" => "/admin/discounts", "name" => "Descuentos"],
      ["name" => "Crear"]
    ];
    $discount = new HaberDescuento([
      'tipo' => 'descuento'
    ]);
    return view('admin.discounts.create', compact('breadcrumbs', 'discount'));
  }

  public function store(DescuentoCreatedRequest $request)
  {
    HaberDescuento::create(array_merge($request->all(), [
      'tipo' => 'descuento',
      'user_id' => Auth::id()
    ]));

    return redirect()->route('discounts.index')->with('success', 'Registrado correctamente.');
  }

  public function edit(HaberDescuento $discount): View
  {
    $breadcrumbs = [
      ["link" => "/dashboard", "name" => "Home"],
      ["link" => "/admin/discounts", "name" => "Descuentos"],
      ["name" => "Editar"]
    ];
    return view('admin.discounts.edit', compact('breadcrumbs', 'discount'));
  }

  public function update(DescuentoUpdatedRequest $request, HaberDescuento $discount)
  {
    $discount->update($request->all());

    return redirect()->route('discounts.index')->with('success', 'Editado correctamente.');
  }

  public function destroy($id)
  {
    $descuento = HaberDescuento::findOrFail($id);

    if ($descuento->delete()) {
      return response()->json([
        'descuento' => $descuento,
      ]);
    }
  }
}
