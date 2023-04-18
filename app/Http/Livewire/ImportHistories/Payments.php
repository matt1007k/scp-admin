<?php

namespace App\Http\Livewire\ImportHistories;

use App\Models\ImportHistory;
use App\Models\Pago;
use App\Services\PersonasService;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Payments extends Component
{
  use WithPagination;

  protected $queryString = [
    'perPage',
  ];

  public $perPage = 10;

  public function render(): View
  {
    $histories = ImportHistory::query()
      ->where('type', 'payments')
      ->latest()
      ->paginate($this->perPage);

    return view('livewire.import-histories.payments', compact('histories'));
  }

  public function refreshPage()
  {
    dd('refresh');
  }

  public function destroy(ImportHistory $history)
  {
    $isDeleted = false;
    $year = substr($history->period_name, 0, -3);
    $month = substr($history->period_name, 4, -1);
    $status = (new PersonasService)->getEstado(substr($history->period_name, -1));

    $payments = Pago::where('anio', $year)->where('mes', $month)->whereHas('persona', function ($q) use ($status) {
      $q->where('estado', $status);
    })->get();
    if ($payments->count() > 0) {
      foreach ($payments as $payment) {
        $payment->delete();
      }
      $isDeleted = true;
    }
    if ($isDeleted) {
      $history->delete();
      $url = "?perPage={$this->perPage}&page={$this->page}";
      session()->flash('success', 'Se eliminó correctamente.');
      return redirect()->to('/admin/imports/payments' . $url);
    }
  }
}
