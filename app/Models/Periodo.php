<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Periodo extends Model
{
  protected $fillable = ['anio'];


  public function volumes(): HasMany
  {
    return $this->hasMany(\App\Models\Volume::class);
  }
}
