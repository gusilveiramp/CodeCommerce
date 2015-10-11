<?php

namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'description'];

    public function products()
    {
    	//Lista os produtos da categoria respectiva
    	return $this->hasMany('CodeCommerce\products');
    }
}
