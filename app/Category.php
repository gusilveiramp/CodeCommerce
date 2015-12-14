<?php

namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    protected $fillable = ['name', 'description'];

    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function products()
    {
    	//Com isso eu acesso todos os items referentes a essa categoria.
    	//ATENÇÃO!!! AQUI ESTAVA 'CodeCommerce\products', eu mudei para Product.
    	//MESMO QUE EU APAGUE TODO A LINHA "return $this->hasMany('CodeCommerce\Product');" 
    	//AS MINHAS CATEGORIAS CONTINUAM CARREGANDO NORMALMENTE. O SITE FUNCIONA NORMALMENTE.
    	//Mesmo que eu exclua essa linha, continua funcionando normalmente. Perguntar ao Wesley!!!
    	return $this->hasMany('CodeCommerce\Product');
    }
}
