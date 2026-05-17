<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IPAddress extends Model
{
    protected $fillable = ['ip_address', 'user_agent'];

}
