<?php

namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function products()
    {
    	// pego todos os produtos relacionados a esta tag
    	return $this->belongsToManu('CodeCommerce\Product');
    }
}
