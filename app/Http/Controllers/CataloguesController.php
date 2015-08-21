<?php namespace App\Http\Controllers;

use App\Catalogue;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CataloguesController extends Controller {

    public function __construct() {
        $this->middleware('auth', ['except' => 'showCatalogue']);
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $catalogues = Catalogue::all();
        $catalogues->load(['products' => function($query) {
            $query->with('images');
        }]);
        return view('catalogues.index', compact('catalogues'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('catalogues.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$catalogue = new Catalogue($request->only(['name']));
        $catalogue->access_key = strtolower(str_random(6));
        $catalogue->save();
        return redirect('catalogues');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Catalogue $catalogue)
	{
        $catalogue->load('products', 'products.images');
		return view('catalogues.show', compact('catalogue'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    public function add(Request $request, Catalogue $catalogue) {
        $catalogue->products()->sync($request->input('products'), false);
        return redirect()->back();
    }

    public function remove(Request $request, Catalogue $catalogue) {
        $catalogue->products()->detach($request->get('product'));
        return redirect()->back();
    }


    public function showCatalogue($access_key) {
        $catalogue = Catalogue::where('access_key', $access_key)->first();
        if($catalogue) Session::put('catalogue', $catalogue);
        else           abort(404);

        ga('Catalogue - ' .$catalogue->name);
        return redirect('products');
    }

}
