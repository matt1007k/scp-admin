<?php

namespace App\Http\Livewire\Volumes;

use App\Models\Periodo;
use App\Models\Volume;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class VolumeList extends Component
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
  public $year = '';

  public function render(): View
  {
    $volumes = Volume::query()
      ->search($this->search)
      ->byYear($this->year)
      ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
      ->paginate($this->perPage);
    $years = Periodo::orderBy('anio', 'desc')->get();

    return view('livewire.volumes.volume-list', compact('volumes', 'years'));
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

  public function destroy(Volume $volume)
  {

    Gate::authorize('forceDelete', $volume);
    try {
      $volume->delete();
    } catch (\Throwable $th) {
      $url = "?perPage={$this->perPage}&page={$this->page}&search={$this->search}";
      session()->flash('warning', 'Este registro esta siendo utilizado.');
      return redirect()->to('/admin/volumes' . $url);
    }

    $url = "?perPage={$this->perPage}&page={$this->page}&search={$this->search}";
    session()->flash('success', 'Se eliminó correctamente.');
    return redirect()->to('/admin/volumes' . $url);
  }
}
