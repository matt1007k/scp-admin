<?php

namespace App\Http\Livewire\People;

use App\Models\Persona;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class PersonList extends Component
{
  use WithPagination;

  protected $queryString = [
    'search' => ['except' => ''],
    'perPage',
    'sortField',
    'sortAsc',
    'filterValue' => ['as' => 'filterBy']
  ];

  public $isOpen = false;
  public $perPage = 10;
  public $sortField = "id";
  public $sortAsc = false;
  public $search = '';
  public $filterValue = '';

  public function render(): View
  {
    $people = Persona::query()
      ->search($this->search)
      ->filterBy($this->filterValue)
      ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
      ->paginate($this->perPage);

    return view('livewire.people.person-list', compact('people'));
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

  public function destroy(Persona $person)
  {

    Gate::authorize('forceDelete', $person);
    try {
      $person->delete();
    } catch (\Throwable $th) {
      $url = "?perPage={$this->perPage}&page={$this->page}&search={$this->search}";
      session()->flash('warning', 'Este registro esta siendo utilizado.');
      return redirect()->to('/admin/people' . $url);
    }

    $url = "?perPage={$this->perPage}&page={$this->page}&search={$this->search}";
    session()->flash('success', 'Se eliminó correctamente.');
    return redirect()->to('/admin/people' . $url);
  }
}
