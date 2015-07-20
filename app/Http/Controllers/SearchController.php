<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class SearchController extends Controller {

	public function search(Request $request) {
        $query = $request->input('q');
        $query = preg_replace("/[^0-9a-zA-Z_\s]+/", "", preg_replace('!\s+!', ' ', trim($query)));

        $products = new Collection();
        if($query != '')
            $products = Product::search(preg_replace('!\s+!', '%', trim($query)))->latest()->get();
        return view('products.search', compact('products', 'query'));
    }

}
