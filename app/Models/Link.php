<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\ShortLink;
use App\Models\IPAddress;


class Link extends Model
{
    //
    protected $fillable = ['long_link', 'short_link_id', 'ip_address_id'];
    public function shortLink(): HasOne
    {
        return $this->hasOne(ShortLink::class);
    }

    public function ipAddress(): HasOne
    {
        return $this->hasOne(IPAddress::class);
    }
}
