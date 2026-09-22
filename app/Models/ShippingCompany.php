<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingCompany extends Model
{
    protected $fillable = [
        'name',
        'code',
        'description',
        'cost',
        'fast',
        'status',
    ];

    public function countries()
    {
        return $this->belongsToMany(Country::class, 'shipping_company_country', 'shipping_company_id', 'country_id');
    }
}
