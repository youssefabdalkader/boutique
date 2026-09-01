<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'status',
    ];

    public function products()
    {
        return $this->morphedByMany(Product::class, 'taggable');
    }
    public function categories()
    {
        return $this->morphedByMany(Category::class, 'taggable');
    }
}
