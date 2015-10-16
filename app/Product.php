<?php

namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    	'category_id',
    	'name', 
    	'description', 
    	'price', 
    	'featured', 
    	'recommended',
    ];

    public function category()
    {
    	//Lista a categoria do produto respectivo
    	return $this->belongsTo('CodeCommerce\Category');
    }
}
