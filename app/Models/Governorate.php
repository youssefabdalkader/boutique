<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    protected $table = 'governorates';
    protected $fillable = ['name', 'country_id'];
    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }
    public function cities()
    {
        return $this->hasMany('App\Models\City');
    }
}
