<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'category_id', 'image'];


    /**
    * Get the category that owns the product.
    */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
