<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HaberDescuento extends Model
{
  protected $table = 'haber_descuentos';
  protected $fillable = [
    'codigo', 'tipo', 'nombre', 'descripcion', 'descripcion_simple', 'user_id', 'es_imponible'
  ];

  public function createdAtFormat(): string
  {
    return $this->created_at->format('d-m-Y');
  }

  public function user()
  {
    return $this->belongsTo('App\Models\User');
  }

  public function detalles()
  {
    return $this->belongsTo(Detalle::class);
  }

  public function scopeSearch($query, $text)
  {
    if ($text) {
      return $query->where('nombre', 'LIKE', '%' . $text . '%')
        ->orWhere('codigo', 'LIKE', '%' . $text . '%')
        ->orWhere('descripcion', 'LIKE', '%' . $text . '%')
        ->orWhere('descripcion_simple', 'LIKE', '%' . $text . '%');
    }
    return $query;
  }
}
