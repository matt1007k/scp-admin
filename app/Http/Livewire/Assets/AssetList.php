<?php

namespace App\Http\Livewire\Assets;

use App\Models\HaberDescuento;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class AssetList extends Component
{
  use WithPagination;

  protected $queryString = [
    'search' => ['except' => ''],
    'perPage',
    'sortField',
    'sortAsc',
    'filterValue' => ['as' => 'filterBy']
  ];

  public $perPage = 10;
  public $sortField = "id";
  public $sortAsc = false;
  public $search = '';
  public $filterValue = '1';

  public function render(): View
  {
    $assets = HaberDescuento::query()
      ->where('tipo', 'haber')
      ->search($this->search)
      ->where('es_imponible', $this->filterValue)
      ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
      ->paginate($this->perPage);

    return view('livewire.assets.asset-list', compact('assets'));
  }

  public function filterBy(string $value): void
  {
    $this->filterValue = $value;
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

  public function destroy(HaberDescuento $asset)
  {

    Gate::authorize('forceDelete', $asset);
    try {
      $asset->delete();
    } catch (\Throwable $th) {
      $url = "?perPage={$this->perPage}&page={$this->page}&search={$this->search}";
      session()->flash('warning', 'Este registro esta siendo utilizado.');
      return redirect()->to('/admin/assets' . $url);
    }

    $url = "?perPage={$this->perPage}&page={$this->page}&search={$this->search}";
    session()->flash('success', 'Se eliminó correctamente.');
    return redirect()->to('/admin/assets' . $url);
  }
}
