<?php

namespace App\Http\Livewire\Forms;

use App\Models\Form;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class FormList extends Component
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
    $forms = Form::query()
      ->search($this->search)
      ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
      ->paginate($this->perPage);

    return view('livewire.forms.form-list', compact('forms'));
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

  public function destroy(Form $form)
  {

    Gate::authorize('forceDelete', $form);
    try {
      $form->delete();
    } catch (\Throwable $th) {
      $url = "?perPage={$this->perPage}&page={$this->page}&search={$this->search}";
      session()->flash('warning', 'Este registro esta siendo utilizado.');
      return redirect()->to('/admin/forms' . $url);
    }

    $url = "?perPage={$this->perPage}&page={$this->page}&search={$this->search}";
    session()->flash('success', 'Se eliminó correctamente.');
    return redirect()->to('/admin/forms' . $url);
  }
}
