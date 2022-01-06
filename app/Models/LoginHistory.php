<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginHistory extends Model
{

    protected $fillable = [
        'user_id',
        'ip_address',
        'zip_code',
        'city',
        'state',
        'country',
        'browser_name',
        'os_name',
        'device_model',
        'device_type',
    ];
    use HasFactory;
}
