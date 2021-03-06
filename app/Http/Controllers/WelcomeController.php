<?php namespace App\Http\Controllers;

use App\Product;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
        if(Auth::user()) return redirect('enquiries');
        $products = Product::visibleToUser()->with('images')->take(4)->get();
		return view('welcome', compact('products'));
	}

}
