<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\ShortLink;


class Link extends Model
{
    //
    protected $fillable = ['long_link', 'short_link_id'];
    public function shortLink(): BelongsTo
    {
        return $this->belongsTo(ShortLink::class);
    }

    
}
