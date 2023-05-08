<?php

namespace App\Http\Livewire\Payments;

use App\Models\Pago;
use App\Models\Periodo;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\WithPagination;
use App\Services\MesesService;
use Illuminate\Support\Benchmark;
use Illuminate\Support\Facades\Gate;

class PaymentList extends Component
{
  use WithPagination;

  protected $queryString = [
    'search' => ['except' => ''],
    'perPage',
    'sortField',
    'sortAsc',
    'year',
    'month'
  ];

  public $perPage = 10;
  public $sortField = "created_at";
  public $sortAsc = false;
  public $search = '';
  public $year = '';
  public $month = '';

  public function mount(): void
  {
    $this->year = date('Y');
    $this->month = 04;
  }

  public function render(): View
  {
    $years = Periodo::orderBy('anio', 'desc')->get();
    $months = (new MesesService)->getMeses();
    $payments = Pago::query()
      ->select('id', 'persona_id', 'anio', 'mes', 'total_haber', 'total_descuento', 'monto_imponible', 'monto_liquido')
      ->with('persona:id,nombre,apellido_paterno,apellido_materno')
      ->where('anio', $this->year)
      ->where('mes', $this->month)
      ->search($this->search)
      ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
      ->paginate($this->perPage);

    /*  $payments = cache()->remember('payments_' . $this->year . '_' . $this->month . '_' . $this->search . '_' . $this->sortField . '_' . $this->sortAsc . '_' . $this->perPage, 300, function () {
      return Pago::query()
        ->select('id', 'persona_id', 'anio', 'mes', 'total_haber', 'total_descuento', 'monto_imponible', 'monto_liquido')
        ->with('persona:id,nombre,apellido_paterno,apellido_materno')
        ->where('anio', $this->year)
        ->where('mes', $this->month)
        ->search($this->search)
        ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
        ->paginate($this->perPage);
    }); */

    return view('livewire.payments.payment-list', compact('payments', 'years', 'months'));
  }

  public function sortBy(string $field): void
  {
    if ($this->sortField === $field) {
      $this->sortAsc = !$this->sortAsc;
    } else {
      $this->sortAsc = true;
    }

    $this->sortField = $field;
  }

  public function updatingSearch(): void
  {
    $this->resetPage();
  }

  public function clear(): void
  {
    $this->search = '';
    $this->page = 1;
    $this->perPage = 10;
  }

  public function destroy(Pago $payment)
  {

    Gate::authorize('forceDelete', $payment);
    try {
      $payment->delete();
    } catch (\Throwable $th) {
      $url = "?perPage={$this->perPage}&page={$this->page}&search={$this->search}";
      session()->flash('warning', 'Este registro esta siendo utilizado.');
      return redirect()->to('/admin/payments' . $url);
    }

    $url = "?perPage={$this->perPage}&page={$this->page}&search={$this->search}";
    session()->flash('success', 'Se eliminó correctamente.');
    return redirect()->to('/admin/payments' . $url);
  }
}
