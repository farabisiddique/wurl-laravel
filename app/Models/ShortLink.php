<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ShortLink extends Model
{
    protected $fillable = ['link_custom_text', 'domain_id', 'expiration_date', 'single_multi'];

    protected function casts(): array
    {
        return [
            'expiration_date' => 'date',
        ];
    }

    public function domain(): BelongsTo
    {
        return $this->belongsTo(Domain::class);
    }

    public function links(): HasMany
    {
        return $this->hasMany(Link::class);
    }
}
