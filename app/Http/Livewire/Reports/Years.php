<?php

namespace App\Http\Livewire\Reports;

use App\Models\Pago;
use App\Models\Periodo;
use App\Models\Persona;
use App\Services\EncryptService;
use App\Services\YearsService;
use Illuminate\View\View;
use Livewire\Component;

class Years extends Component
{
  public $searchPerson = '';
  public $person;
  public $isSearch = false;
  public $message = '';
  public $yearFrom = '';
  public $yearTo = '';
  public $payments = [];

  public function mount(): void
  {
    $this->yearFrom = date('Y', strtotime("-1 year"));
    $this->yearTo = date('Y');
  }

  public function render(): View
  {
    $people = Persona::search($this->searchPerson)->take(5)->get();
    $years = Periodo::orderBy('anio', 'desc')->get();
    return view('livewire.reports.years', compact('people', 'years'));
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
      'yearFrom' => 'required',
      'yearTo' => 'required',
    ]);

    $this->isSearch = true;

    $payments = Pago::whereBetween('anio', [$this->yearFrom, $this->yearTo])
      ->whereHas('persona', function ($query) {
        $query->where('id', $this->person['id']);
      })->orderBy('anio', 'DESC')->get();

    $years_exist_unique = (new YearsService($this))->getYearsUnique($payments);

    if (count($years_exist_unique) > 0) {
      $this->payments =  $years_exist_unique;
    } else {
      $this->message = 'Los pagos no han sido encontrados';
    }
  }

  public function pathYears(): string
  {
    $string = "{\"anio_anterior\":\"$this->yearTo\",{\"anio_anterior\":\"$this->yearFrom\",\"persona_id\":{$this->person['id']}}";
    $url_decode = (new EncryptService($string))->getEncrypt();
    return route('reports.poranios', $url_decode);
  }
}
