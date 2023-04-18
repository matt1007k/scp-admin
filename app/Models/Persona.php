<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
  protected $fillable = [
    'nombre',
    'apellido_paterno',
    'apellido_materno',
    'dni',
    'codigo_modular',
    'cargo',
    'estado',
    'user_id',
  ];

  protected $appends = ['full_name'];
  protected $dates = ['fecha_nacimiento', 'fecha_inicio', 'fecha_fin', 'fafiliacion', 'fdevengue'];

  public function getFullNameAttribute(): string
  {
    return "$this->apellido_paterno $this->apellido_materno, $this->nombre";
  }

  public function createdAtFormat(): string
  {
    return $this->created_at->format('d-m-Y');
  }

  public function scopeSearch(Builder $query, $value)
  {
    $concat = "apellido_paterno,' ',apellido_materno,', ', nombre";

    return $query->where(function ($query) use ($concat, $value) {
      $query->where('codigo_modular', 'LIKE', '%' . $value . '%')
        ->orWhere('dni', 'LIKE', '%' . $value . '%')
        ->orWhereRaw("CONCAT($concat) LIKE '%" . $value . "%'");
    });
  }

  public function scopeFilterBy(Builder $query, string $value): Builder
  {
    if ($value !== '') {
      return $query->where('estado', $value);
    }
    return $query;
  }

  public function user()
  {
    return $this->belongsTo('App\Models\User');
  }

  public function pagos()
  {
    return $this->hasMany('App\Models\Pago');
  }

  public function judiciales()
  {
    return $this->hasMany('App\Models\Judicial');
  }
}
