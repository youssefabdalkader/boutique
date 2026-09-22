<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    protected $table = 'governorates';
    protected $fillable = ['name', 'country_id'];
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
    public function cities()
    {
        return $this->hasMany(City::class, 'governorate_id');
    }
    public function addresses()
    {
        return $this->hasMany(user_address::class);
    }
}
