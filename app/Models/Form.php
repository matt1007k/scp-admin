<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Form extends Model
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

    public function volume(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Volume::class);
    }

    public function pathFile(): string
    {
        return Storage::disk('public')->exists($this->file)
            ? Storage::url($this->file)
            : "";
    }

    public function deleteStorageFile(): void
    {
        if (Storage::disk('public')->exists($this->file)) {
            Storage::disk('public')->delete($this->file);
        }
    }
}
