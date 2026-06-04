<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Link;

class IPAddress extends Model
{
    protected $fillable = ['ip_address', 'user_agent'];
    public function links(): HasMany
    {
        return $this->hasMany(Link::class);
    }

}
