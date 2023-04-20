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

class Create extends Component
{
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

    protected $listeners = ['personSelected'];

    public function mount(): void
    {
        $this->month = date('m');
        $this->year = date('Y');
    }

    public function render(): View
    {
        $people = Persona::search($this->searchPerson)->take(5)->get();
        $years = Periodo::orderBy('anio', 'desc')->get();
        $months = (new MesesService)->getMeses();
        $assetsDB = HaberDescuento::where('tipo', 'haber')->search($this->searchAsset)->take(5)->get();
        $discountsDB = HaberDescuento::where('tipo', 'descuento')->search($this->searchDiscount)->take(5)->get();

        return view('livewire.payments.create', compact('assetsDB', 'discountsDB', 'years', 'months', 'people'));
    }

    public function personSelected(Persona $person): void
    {
        $this->person = $person;
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

        $pago = Pago::create([
            'persona_id' => $this->person['id'],
            'anio' => $this->year,
            'mes' => $this->month,
            'total_haber' => $this->assetsTotal,
            'total_descuento' => $this->discountsTotal,
            'monto_imponible' => $this->imponibleTotal,
            'monto_liquido' => $this->liquidTotal,
            'user_id' =>  auth()->user()->id
        ]);


        if ($pago) {
            foreach ($detalles as $detalle) {
                Detalle::create([
                    'pago_id' => $pago->id,
                    'hd_id' => $detalle['id'],
                    'monto' => $detalle['monto']
                ]);
            }
            session()->flash('success', 'Registrado correctamente.');
            return redirect()->to('/admin/payments');
        }
    }
}
