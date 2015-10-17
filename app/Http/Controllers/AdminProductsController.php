<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Category;
use CodeCommerce\Http\Requests;
//use CodeCommerce\Http\Controllers\Controller;
use CodeCommerce\Product;
use CodeCommerce\ProductImage;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class AdminProductsController extends Controller
{
    private $model;

    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products =  $this->model->paginate(10);

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category) //method injection =  o Laravel injeta o objeto automaticamente para mim.
    {
        // envio as categorias para a view products.create
        $categories = $category->lists('name', 'id');

        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\ProductRequest $request)
    {
        $this->model->create($request->all());

        return redirect()->route('admin.products');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Category $category)
    {
        // envio as categorias para a view products.create
        $categories = $category->lists('name', 'id');

        $product = $this->model->find($id);

        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\ProductRequest $request, $id)
    {

        $request['featured'] = $request->get('featured');
        $request['recommended'] = $request->get('recommended');

        $this->model->find($id)->update($request->all());

        return redirect()->route('admin.products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->model->find($id)->delete();

        return redirect()->route('admin.products');
    }

    public function images($id)
    {
        $product = $this->model->find($id);

        return view('products.images', compact('product'));
    }

    public function createImage($id)
    {
        $product = $this->model->find($id);

        return view('products.create_image', compact('product'));
    }

    public function storeImage(Requests\ProductImageRequest $request, $id, ProductImage $productImage)
    {
        // guardo imagem do form na variável $file
        $file = $request->file('image');

        // metodo que pega a extensão original do arquivo
        $extension = $file->getClientOriginalExtension();

        // gravo no banco de dados o id do produto e a extensão através da instancia productImage 
        $image = $productImage::create(['product_id'=>$id, 'extension'=>$extension]);

        // Utilizando a Facade Storage eu insiro a imagem no disco public_local, criado por mim no arquivo config/filesystems.php.
        // nesse caso, as imagens são inseridas na pasta public/uploads
        Storage::disk('public_local')->put($image->id.'.'.$extension, File::get($file));

        return redirect()->route('admin.products.images', ['id'=>$id]);
    }

    public function destroyImage(ProductImage $productImage, $id)
    {
        // selecione a imagem pelo id
        $image = $productImage->find($id);

        // se o arquivo existir na pasta
        if(file_exists(public_path() . '/uploads/' . $image->id . '.' . $image->extension))
        {
            // Excluo a imagem da pasta utilizando o id e a extensão
            Storage::disk('public_local')->delete($image->id.'.'.$image->extension);    
        }
        
        // seleciono o product da imagem para dar o return logo abaixo
        $product = $image->product;

        // excluo a imagem do BD
        $image->delete();

        return redirect()->route('admin.products.images', ['id'=>$product->id]);

    }
}
