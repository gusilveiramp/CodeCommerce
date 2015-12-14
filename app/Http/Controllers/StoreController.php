<?php

namespace CodeCommerce\Http\Controllers;

//use CodeCommerce\Http\Requests; //Apagar...Não está sendo usado
//use CodeCommerce\Http\Controllers\Controller; //Apagar...Não está sendo usada
//use Illuminate\Http\Request; 
use CodeCommerce\Category;
use CodeCommerce\Product;

class StoreController extends Controller
{
    private $categoryModel;
    private $productModel;

    public function __construct(Category $category, Product $product)
    {
        $this->categoryModel = $category;
        $this->productModel = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // acesso o metodo scoopFeatured do model e tráz do BD os produtos marcados com valor 1 no campo featured
        $pFeatured = $this->productModel->featured()->get();
        //$pFeatured = Product::featured()->get();

        // acesso o metodo scoopRecommended do model e tráz do BD os produtos marcados com valor 1 no campo Recommended
        $pRecommended = $this->productModel->recommended()->get();
        //$pRecommended =  = Product::recommended()->get();

        // carrego o model Category;
        $categories = $this->categoryModel->all();
        //$categories = Category::all();

        return view('store.index', compact('categories', 'pFeatured', 'pRecommended'));
    }

    // exibe categorias de produtos
    public function category($id)
    {   
        // seleciono todas as categorias do bd
        $categories = $this->categoryModel->all();
        //$categories = Category::all();

        // seleciono a categorua pelo id
        $category = $this->categoryModel->find($id);

        // digo que quero pegar o produto da categoria $id
        $products = $this->productModel->ofCategory($id)->get();

        return view('store.category', compact('categories','category','products'));
    }

    public function product($id)
    {
        // seleciono todas as categorias do bd
        $categories = $this->categoryModel->all();
        //$categories = Category::all();
        
        // seleciono o produto pelo id
        $product = $this->productModel->find($id);
        //$product = Product::find($id);

        return view('store.product', compact('categories','product'));
    }

    public function search()
    {
        // seleciono todas as categorias do bd
        $categories = $this->categoryModel->all();
        //$categories = Category::all();

        $keyword = \Request::get('keyword'); //<-- we use global request to get the param of URI

        $products = $this->productModel->ofSearch($keyword)->orderBy('name')->paginate(10);
     
        return view('store.search',compact('products', 'categories'));
    }
}