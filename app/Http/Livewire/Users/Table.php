<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
  /*-----------------DATATABLE -----------------*/
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
  public $filterValue = '';

  public function render(): View
  {
    $users = User::query()
      ->search($this->search)
      ->filterBy($this->filterValue)
      ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
      ->paginate($this->perPage);

    return view('livewire.users.table', compact('users'));
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

  public function destroy(User $user)
  {

    Gate::authorize('forceDelete', $user);
    try {
      $user->delete();
    } catch (\Throwable $th) {
      $url = "?perPage={$this->perPage}&page={$this->page}&search={$this->search}";
      session()->flash('warning', 'Este registro esta siendo utilizado.');
      return redirect()->to('/admin/users' . $url);
    }

    $url = "?perPage={$this->perPage}&page={$this->page}&search={$this->search}";
    session()->flash('success', 'Se eliminó correctamente.');
    return redirect()->to('/admin/users' . $url);
  }
}
