<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasActiveStatus
{
    public function scopeActive(Builder $builder)
    {
        return $builder->where($this->qualifyColumn('status'), 1);
    }
}
