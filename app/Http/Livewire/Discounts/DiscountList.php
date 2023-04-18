<?php

namespace App\Http\Livewire\Discounts;

use App\Models\HaberDescuento;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class DiscountList extends Component
{
  use WithPagination;

  protected $queryString = [
    'search' => ['except' => ''],
    'perPage',
    'sortField',
    'sortAsc',
  ];

  public $perPage = 10;
  public $sortField = "id";
  public $sortAsc = false;
  public $search = '';

  public function render(): View
  {
    $discounts = HaberDescuento::query()
      ->where('tipo', 'descuento')
      ->search($this->search)
      ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
      ->paginate($this->perPage);

    return view('livewire.discounts.discount-list', compact('discounts'));
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

  public function destroy(HaberDescuento $discount)
  {

    Gate::authorize('forceDelete', $discount);
    try {
      $discount->delete();
    } catch (\Throwable $th) {
      $url = "?perPage={$this->perPage}&page={$this->page}&search={$this->search}";
      session()->flash('warning', 'Este registro esta siendo utilizado.');
      return redirect()->to('/admin/discounts' . $url);
    }

    $url = "?perPage={$this->perPage}&page={$this->page}&search={$this->search}";
    session()->flash('success', 'Se eliminó correctamente.');
    return redirect()->to('/admin/discounts' . $url);
  }
}
