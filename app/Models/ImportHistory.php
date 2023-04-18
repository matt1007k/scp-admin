<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportHistory extends Model
{
  use HasFactory;

  protected $guarded = [];

  public function createdAtFormat(): string
  {
    return $this->created_at->format('d-m-Y H:m:s');
  }
}
