<?php

namespace App\Http\Livewire\People;

use App\Http\Livewire\Autocomplete;
use App\Models\Persona;

class PersonAutocomplete extends Autocomplete
{
  protected $listeners = ['valueSelected'];

  public function valueSelected(Persona $person): void
  {
    $this->emitUp('personSelected', $person);
  }

  public function query()
  {
      return collect(Persona::search($this->search)->take(5))->map(function ($person) {
          return [
              'id' => $person['id'],
              'name' => $person['full_name']
          ];
      });
  }
}
