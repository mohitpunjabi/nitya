<?php namespace App\Http\Controllers;

use App\Catalogue;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\ProductRequest;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProductsController extends Controller {

    public function __construct() {
        $public = ['index', 'show'];
        $this->middleware('productVisible', ['only' => 'show']);
        $this->middleware('auth', ['except' => $public]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
	public function index(Request $request)
	{
        $products = Product::visibleToUser()
                    ->with(Product::getAssociatedModels())
                    ->simplePaginate(8);

        if($request->input('responseType') == 'JSON')
            return [
                'nextPageUrl' => $products->nextPageUrl(),
                'data'        => $products->lists('thumbnail_markup')
            ];
        return view('products.index', compact('products'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $catalogues = Catalogue::all()->lists('name', 'id');
		return view('products.create', compact('catalogues'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(ProductRequest $request)
	{
        $product = new Product($request->all());
        $this->updateProduct($product, $request);
        return redirect('products/' . $product->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Product $product, $slug = '')
	{
        if($slug !== $product->slug) return redirect(url_product($product));
        $product->load(Product::getAssociatedModels());
		return view('products.show', compact('product'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Product $product)
	{
        $catalogues = Catalogue::all()->lists('name', 'id');
		return view('products.edit', compact('product', 'catalogues'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Product $product, ProductRequest $request)
	{
		$product->update($request->all());
        $this->updateProduct($product, $request);
        return redirect('products/' . $product->id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Product $product)
	{
		$product->delete();
        return redirect()->route('products.index');
	}

    public function removeImage(Product $product, \App\Image $image) {
        $image->delete();
        return redirect()->back();
    }

    public function search(Request $request) {
        $searchTerm = $request->get('q');
        return Product::search($searchTerm)->with(Product::getAssociatedModels())->get();
    }


    private function updateProduct(Product $product, ProductRequest $request) {
        $product->available = $request->has('available');
        $product->save();
        $this->saveImages($product, $request->file('images'));
        $this->syncCatalogues($product, $request->input('catalogue_list'));
    }

    private function saveImages(Product $product, $imageFiles = []) {
        $images = [];
        foreach($imageFiles as $imageFile) {
            if($imageFile != null)  array_push($images, new \App\Image(['name' => $this->processImage($product, $imageFile)]));
        }
        $product->images()->saveMany($images);
    }

    private function processImage(Product $product, UploadedFile $image) {
        $imageName = $product->design_no . '-' .
                     substr(str_slug($product->name), 0, 10) .
                     '-' . str_random(6) .
                     '.' . $image->getClientOriginalExtension();
        Image::make($image)
            ->heighten(2000, function($constraint) {
                $constraint->upsize();
            })->save('img/lg/' . $imageName)
            ->heighten(800)->save('img/md/' . $imageName)
            ->heighten(120)->save('img/sm/' . $imageName);

        return $imageName;
    }

    private function syncCatalogues(Product $product, $catalogues = [])
    {
        if($catalogues == null) $catalogues = [];
        $product->catalogues()->sync($catalogues);
    }

}
