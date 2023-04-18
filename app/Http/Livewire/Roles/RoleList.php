<?php

namespace App\Http\Livewire\Roles;

use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class RoleList extends Component
{
  use WithPagination;

  protected $queryString = [
    'search' => ['except' => ''],
    'perPage',
  ];

  public $isOpen = false;
  public $perPage = 10;
  public $sortField = "id";
  public $sortAsc = true;
  public $search = '';
  public $filterValue = '1';

  public function render(): View
  {
    $roles = Role::query()
      ->where('name', 'LIKE', "%$this->search%")
      ->where('status', $this->filterValue)
      ->latest()
      ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
      ->paginate($this->perPage);

    return view('livewire.roles.role-list', compact('roles'));
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

  public function destroy(Role $role)
  {
    Gate::authorize('forceDelete', $role);
    try {
      $role->delete();
    } catch (\Throwable $th) {
      $url = "?perPage={$this->perPage}&page={$this->page}&search={$this->search}";
      session()->flash('warning', 'Este registro esta siendo utilizado.');
      return redirect()->to('/admin/roles' . $url);
    }

    $url = "?perPage={$this->perPage}&page={$this->page}&search={$this->search}";
    session()->flash('success', 'Se eliminó correctamente.');
    return redirect()->to('/admin/roles' . $url);
  }
}
