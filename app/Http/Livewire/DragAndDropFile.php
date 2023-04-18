<?php

namespace App\Http\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class DragAndDropFile extends Component
{
  public $url;
  public $onlyAccept;

  public function mount(string $url = '', string $onlyAccept = 'application/pdf'): void
  {
    $this->url = $url;
    $this->onlyAccept = $onlyAccept;
  }

  public function render(): View
  {
    return view('livewire.drag-and-drop-file');
  }
}
