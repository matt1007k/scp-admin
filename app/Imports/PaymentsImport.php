<?php

namespace App\Imports;

use App\Models\Pago;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PaymentsImport implements ToModel, WithHeadingRow
{
  /**
   * @param array $row
   *
   * @return \Illuminate\Database\Eloquent\Model|null
   */
  public function model(array $row)
  {
    return new Pago([
      'nombre' => $row['nombres'],
      'apellido_paterno' => $row['apepat'],
      'apellido_materno' => $row['apemat'],
      'dni' => $row['dni'],
      'codigo_modular' => $row['codmod'],
      'cargo' => $row['cargo'],
    ]);
  }
}
