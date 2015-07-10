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
        if(Product::visibleToUser()->where('id', $request->route()->parameter('products')->id)->exists())
    		return $next($request);

        abort(404);
	}

}