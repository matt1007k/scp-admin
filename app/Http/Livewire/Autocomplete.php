<?php

namespace App\Http\Livewire;

use Illuminate\View\View;
use Livewire\Component;

abstract class Autocomplete extends Component
{
  public $results;
  public $search;
  public $selected;
  public $showDropdown;

  abstract public function query();

  public function mount(): void
  {
    $this->showDropdown = false;
    $this->results = collect();
  }

  public function updatedSelected(): void
  {
    $this->emitSelf('valueSelected', $this->selected);
  }

  public function updatedSearch(): void
  {
    if (strlen($this->search) < 2) {
      $this->results = collect();
      $this->showDropdown = false;
      return;
    }

    if ($this->query()) {
      $this->results = $this->query()->get();
    } else {
      $this->results = collect();
    }

    $this->selected = '';
    $this->showDropdown = true;
  }

  public function render(): View
  {
    return view('livewire.autocomplete');
  }
}
