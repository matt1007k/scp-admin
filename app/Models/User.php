<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable, HasRoles;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name', 'email', 'password', 'dni', 'estado',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function createdAtFormat(): string
  {
    return $this->created_at->format('d-m-Y');
  }

  public function personas(): HasMany
  {
    return $this->hasMany('App\Models\Persona');
  }

  public function haberDescuentos(): HasMany
  {
    return $this->hasMany('App\Models\HaberDescuento');
  }

  public function pagos(): HasMany
  {
    return $this->hasMany(\App\Models\Pago::class);
  }

  public function scopeSearch(Builder $query, string $value): Builder
  {
    return $query->where('name', 'LIKE', "%{$value}%")
      ->orWhere('email', 'LIKE', "%{$value}%")
      ->orWhere('dni', 'LIKE', "%{$value}%");
  }

  public function scopeFilterBy(Builder $query, string $value): Builder
  {
    if ($value !== '') {
      return $query->where('estado', $value);
    }
    return $query;
  }
}
