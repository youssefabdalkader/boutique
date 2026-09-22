<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_address extends Model
{
    use HasFactory;
    //
    protected $fillable = [
        'user_id',
        'address_title',
        'default_address',
        'address',
        'address2',
        'zip_code',
        'po_box',
        'country_id',
        'governorate_id',
        'city_id',
    ];

    protected $casts = [
        'default_address' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function governorate()
    {
        return $this->belongsTo(Governorate::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
