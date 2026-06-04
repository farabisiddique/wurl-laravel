<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Domain;
use App\Models\Link;

class ShortLink extends Model
{   
    protected $fillable = ['link_custom_text', 'domain_id','expiration_date'];
    public function domain(): HasOne
    {
        return $this->hasOne(Domain::class);
    }
    public function link(): HasOne
    {
        return $this->hasOne(Link::class);
    }

}
