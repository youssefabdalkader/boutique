<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingCompanyCountry extends Model
{
    protected $fillable = [
        'shipping_company_id',
        'country_id',
    ];
}
