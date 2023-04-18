<?php

namespace App\Http\Livewire\Reports;

use App\Models\Judicial;
use App\Models\Periodo;
use App\Models\Persona;
use App\Services\MesesService;
use Illuminate\View\View;
use Livewire\Component;

class Judicials extends Component
{
  public $searchPerson = '';
  public $person;
  public $isSearch = false;
  public $message = '';
  public $year = '';
  public $month = '';
  public $judicial;

  public function mount(): void
  {
    $this->year = date('Y');
    $this->month = date('m');
  }

  public function render(): View
  {
    $people = Persona::search($this->searchPerson)->take(5)->get();
    $years = Periodo::orderBy('anio', 'desc')->get();
    $months = (new MesesService)->getMeses();
    return view('livewire.reports.judicials', compact('people', 'years', 'months'));
  }

  public function selectedPerson(Persona $person): void
  {
    $this->person = collect($person);
    $this->searchPerson = '';
  }

  public function handleSearch(): void
  {
    $this->message = '';
    $this->isSearch = false;
    $this->validate([
      'person' => 'required',
      'year' => 'required',
      'month' => 'required',
    ]);

    $periodo = (string) $this->year . $this->month;

    $this->isSearch = true;
    $this->judicial = Judicial::where('periodo', $periodo)
      ->whereHas('persona', function ($query) {
        $query->where('id', $this->person['id']);
      })->first();

    if (!$this->judicial) {
      $this->message = 'El judicial de este periodo no ha sido encontrado';
    }
  }
}
