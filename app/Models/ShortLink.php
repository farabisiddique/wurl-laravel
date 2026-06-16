<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use App\Models\Domain;
use App\Models\Link;

class ShortLink extends Model
{   
    protected $fillable = ['link_custom_text', 'domain_id','expiration_date','single_multi'];
    public function domain(): HasOne
    {
        return $this->hasOne(Domain::class);
    }
    public function link(): HasOneOrMany
    {
        return $this->hasMany(Link::class);
    }

}
