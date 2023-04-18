<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Volume extends Model
{
  use HasFactory;

  protected $guarded = [];

  public function createdAtFormat(): string
  {
    return $this->created_at->format('d-m-Y');
  }

  public function scopeSearch(Builder $query, string $value): Builder
  {
    return $query->where('name', 'LIKE', "%{$value}%");
  }

  public function scopeByYear(Builder $query, string $year): Builder
  {
    if ($year) {
      return $query->whereHas('year', function ($query) use ($year) {
        $query->where('anio', $year);
      });
    }
    return $query;
  }

  public function year(): BelongsTo
  {
    return $this->belongsTo(\App\Models\Periodo::class, 'year_id');
  }

  public function forms(): HasMany
  {
    return $this->hasMany(\App\Models\Form::class);
  }
}
