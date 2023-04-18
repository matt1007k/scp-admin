<?php

namespace App\Http\Livewire\Payments;

use App\Models\Detalle;
use App\Models\HaberDescuento;
use App\Models\Pago;
use App\Models\Periodo;
use App\Models\Persona;
use App\Services\MesesService;
use Illuminate\View\View;
use Livewire\Component;

class Edit extends Component
{
  public $payment;
  public $person;
  public $year = '';
  public $month = '';
  public $assets = [];
  public $discounts = [];
  public $searchPerson = '';
  public $searchAsset = '';
  public $searchDiscount = '';
  public $message = '';
  public $assetsTotal = 0;
  public $discountsTotal = 0;
  public $imponibleTotal = 0;
  public $liquidTotal = 0;

  public function mount(Pago $payment): void
  {
    $this->payment = $payment;
    $this->year = $payment->anio;
    $this->month = $payment->mes;
    $this->person = collect($payment->persona);
    $this->assetsTotal = $payment->total_haber;
    $this->discountsTotal = $payment->total_descuento;
    $this->imponibleTotal = $payment->monto_imponible;
    $this->liquidTotal = $payment->monto_liquido;

    foreach ($payment->detalles as $detalle) {
      $hd = HaberDescuento::findOrfail($detalle->hd_id);
      if ($hd->tipo == 'haber') {
        array_push($this->assets, [
          "id" => $hd->id,
          "codigo" => $hd->codigo,
          "tipo" => $hd->tipo,
          "nombre" => $hd->nombre,
          "descripcion" => $hd->descripcion,
          "descripcion_simple" => $hd->descripcion_simple,
          "user_id" => $hd->user_id,
          "es_imponible" => $hd->es_imponible,
          "created_at" => $hd->created_at,
          "updated_at" => $hd->updated_at,
          "hd_id" => $hd->id,
          "monto" => $detalle->monto,
          "detalle_id" => $detalle->id,
        ]);
      } elseif ($hd->tipo == 'descuento') {
        array_push($this->discounts, [
          "id" => $hd->id,
          "codigo" => $hd->codigo,
          "tipo" => $hd->tipo,
          "nombre" => $hd->nombre,
          "descripcion" => $hd->descripcion,
          "descripcion_simple" => $hd->descripcion_simple,
          "user_id" => $hd->user_id,
          "es_imponible" => $hd->es_imponible,
          "created_at" => $hd->created_at,
          "updated_at" => $hd->updated_at,
          "hd_id" => $hd->id,
          "monto" => $detalle->monto,
          "detalle_id" => $detalle->id,
        ]);
      }
    }
  }

  public function render(): View
  {
    $people = Persona::search($this->searchPerson)->take(5)->get();
    $years = Periodo::orderBy('anio', 'desc')->get();
    $months = (new MesesService)->getMeses();
    $assetsDB = HaberDescuento::where('tipo', 'haber')->search($this->searchAsset)->take(5)->get();
    $discountsDB = HaberDescuento::where('tipo', 'descuento')->search($this->searchDiscount)->take(5)->get();

    return view('livewire.payments.edit', compact('assetsDB', 'discountsDB', 'years', 'months', 'people'));
  }

  public function selectedPerson(Persona $person): void
  {
    $this->person = collect($person);
    $this->searchPerson = '';
  }

  public function selectedAsset(HaberDescuento $asset): void
  {
    $assetsCol = collect($this->assets);
    if ($this->hasAddedAsset($asset->id)) {
      $this->message = 'El haber ya ha sido agregado';
      return;
    }
    $this->message = '';
    $this->assets = $assetsCol->push([
      'id' => $asset->id,
      'nombre' => $asset->nombre,
      'descripcion' => $asset->descripcion,
      'descripcion_simple' => $asset->descripcion_simple,
      'es_imponible' => $asset->es_imponible,
      'monto' => 0
    ]);
    $this->message = "El haber {$asset->descripcion} fue agregado";
    $this->searchAsset = '';
  }

  public function hasAddedAsset(int $id): bool
  {
    return collect($this->assets)->contains('id', $id);
  }

  public function selectedDiscount(HaberDescuento $discount): void
  {
    $discountsCol = collect($this->discounts);
    if ($this->hasAddedDiscount($discount->id)) {
      $this->message = 'El descuento ya ha sido agregado';
      return;
    }
    $this->message = '';
    $this->discounts = $discountsCol->push([
      'id' => $discount->id,
      'nombre' => $discount->nombre,
      'descripcion' => $discount->descripcion,
      'descripcion_simple' => $discount->descripcion_simple,
      'es_imponible' => $discount->es_imponible,
      'monto' => 0
    ]);
    $this->message = "El descuento {$discount->descripcion} fue agregado";
    $this->searchDiscount = '';
  }

  public function hasAddedDiscount(int $id): bool
  {
    return collect($this->discounts)->contains('id', $id);
  }

  public function handleSubmit()
  {
    $this->validate([
      'person' => 'required',
      'year' => 'required',
      'month' => 'required',
      'assets' => 'required',
      'discounts' => 'required',
    ]);

    $detalles = array_merge($this->assets, $this->discounts);

    $this->payment->update([
      'persona_id' => $this->person['id'],
      'anio' => $this->year,
      'mes' => $this->month,
      'total_haber' => $this->assetsTotal,
      'total_descuento' => $this->discountsTotal,
      'monto_imponible' => $this->imponibleTotal,
      'monto_liquido' => $this->liquidTotal,
    ]);


    if ($this->payment) {
      foreach ($detalles as $detalle) {
        $detalle_db = Detalle::where('hd_id', $detalle['hd_id'])
          ->where('pago_id', $this->payment->id)->first();
        if ($detalle_db) {
        }
        $updatedIds = [];
        $newItems = [];
        // 1. filter and update
        foreach ($detalles as $detalle) {
          $detalle_db = Detalle::where('hd_id', $detalle['hd_id'])
            ->where('pago_id', $this->payment->id)->first();
          if ($detalle_db) {
            $detalle_db->update([
              'pago_id' => $this->payment->id,
              'hd_id' => $detalle['id'],
              'monto' => $detalle['monto']
            ]);
            $updatedIds[] = $detalle_db->id;
          } else {
            $newItems[] = $detalle;
          }
        }

        // 2. delete non-updated items
        Detalle::whereNotIn('id', $updatedIds)
          ->where('pago_id', $this->payment->id)
          ->delete();

        // 3. save new items
        if (count($newItems)) {
          foreach ($newItems as $detalle_new) {
            Detalle::create([
              'pago_id' => $this->payment->id,
              'hd_id' => $detalle_new['hd_id'],
              'monto' => $detalle_new['monto']
            ]);
          }
        }
      }
      session()->flash('success', 'Editado correctamente.');
      return redirect()->to('/admin/payments');
    }
  }
}
