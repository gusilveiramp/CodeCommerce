<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Product;
use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AdminProductsController extends Controller
{
    private $productModel;

    public function __construct(Product $productModel)
    {
        $this->productModel = $productModel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products =  $this->productModel->all();

        return view('products.index', compact('products'));
    }
}
