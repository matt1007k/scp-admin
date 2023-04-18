<?php

namespace App\Http\Livewire\Reports;

use App\Models\Pago;
use App\Models\Periodo;
use App\Models\Persona;
use App\Services\EncryptService;
use Illuminate\View\View;
use Livewire\Component;

class Year extends Component
{
  public $searchPerson = '';
  public $person;
  public $isSearch = false;
  public $message = '';
  public $year = '';
  public $payment;

  public function mount(): void
  {
    $this->year = date('Y');
    $this->person = null;
  }

  public function render(): View
  {
    $people = Persona::search($this->searchPerson)->take(5)->get();
    $years = Periodo::orderBy('anio', 'desc')->get();
    return view('livewire.reports.year', compact('people', 'years'));
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
    ]);

    $this->isSearch = true;
    $this->payment = Pago::where('anio', $this->year)
      ->whereHas('persona', function ($query) {
        $query->where('id', $this->person['id']);
      })->first();

    if (!$this->payment) {
      $this->message = 'El pago no ha sido encontrado';
    }
  }

  public function pathYear()
  {
    $string = "{\"anio\":\"$this->year\",\"persona_id\":{$this->person['id']},\"certificado\":\"\",\"ver\":0}";
    $url_decode = (new EncryptService($string))->getEncrypt();
    return route('reports.poranio', $url_decode);
  }
}
