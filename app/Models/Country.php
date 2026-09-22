<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'name',
        'status',
    ];

    public function governorates()
    {
        return $this->hasMany(Governorate::class);
    }



    public function addresses()
    {
        return $this->hasMany(user_address::class);
    }

    public function shippingCompanies()
    {
        return $this->belongsToMany(ShippingCompany::class, 'shipping_company_country', 'country_id', 'shipping_company_id');
    }
}
