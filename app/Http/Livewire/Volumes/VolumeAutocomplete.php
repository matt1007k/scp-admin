<?php

namespace App\Http\Livewire\Volumes;

use App\Http\Livewire\Autocomplete;
use App\Models\Volume;

class VolumeAutocomplete extends Autocomplete
{
  protected $listeners = ['valueSelected'];

  public function valueSelected(Volume $volume): void
  {
    $this->emitUp('volumeSelected', $volume);
  }

  public function query()
  {
    return Volume::search($this->search)->take(5);
  }
}
