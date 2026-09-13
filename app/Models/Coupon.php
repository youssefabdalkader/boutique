<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'description',
        'type',
        'use_times',
        'used_times',
        'value',
        'starts_at',
        'expires_at',
        'status',
        'greater_than',
    ];
}
