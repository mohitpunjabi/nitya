<?php namespace App\Http\Middleware;

use App\Product;
use Closure;
use Illuminate\Support\Facades\Session;

class IsProductVisible {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        $product = $request->route()->parameter('products');
        if(Product::visibleToUser()->where('id', $product->id)->exists())
    		return $next($request);

        return view('contact', [
            'title' => $product->name,
            'subtitle' => 'To view this product, to place an order or to get price details, please reach out to us.',
            'showMap'  => false
        ]);
	}

}