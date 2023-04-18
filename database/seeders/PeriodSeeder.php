<?php

namespace Database\Seeders;

use App\Models\Periodo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeriodSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    Periodo::truncate();

    foreach (range(0, 9) as $i) {
      Periodo::create(['anio' => '199' . $i]);
    }

    foreach (range(0, 23) as $i) {
      $num = '';
      if ($i < 10) {
        $num = '0' . $i;
      } else {
        $num = $i;
      }
      Periodo::create(['anio' => '20' . $num]);
    }
  }
}
