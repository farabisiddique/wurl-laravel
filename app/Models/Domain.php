<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\ShortLink;

class Domain extends Model
{
    protected $fillable = ['domain_name', 'is_active'];
    public function shortlink(): HasMany
    {
        return $this->hasMany(ShortLink::class);
    }
}
