<?php

namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'description'];

    public function products()
    {
    	//Com isso eu acesso todos os items referentes a essa categoria.
    	return $this->hasMany('CodeCommerce\products');
    }
}
