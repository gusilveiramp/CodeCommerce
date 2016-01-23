<?php

namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Color extends Model
{
	use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

	protected $fillable = ['name'];

    public function products()
    {
    	// Esta tag pertence a muitos produtos.
    	// Este metodo tráz os produtos relacionados a tag em questão.
    	// 'product_tag' é a tabela que está fazendo os relacionamentos.
    	return $this->belongsToMany('CodeCommerce\Product', 'product_color');
    }
}