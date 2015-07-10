<?php namespace App\Http\Controllers;

use App\Enquiry;
use App\Http\Requests;

use App\Http\Requests\EnquiryRequest;
use App\Product;
use Illuminate\Support\Facades\Session;

class EnquiriesController extends Controller {

    public function __construct() {
        $this->middleware('auth', ['only' => ['index', 'show']]);
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$enquiries = Enquiry::with('product')->latest()->paginate(10);
        return view('enquiries.index', compact('enquiries'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(EnquiryRequest $request)
	{
        Session::put('user_info', $request->only(['name', 'email', 'contact', 'message']));
		$enquiry = new Enquiry($request->all());
        if($request->has('product_id')) {
            Product::find($request->input('product_id'))->enquiries()->save($enquiry);
        } else {
            $enquiry->save();
        }

        return redirect()->back()->withInput()->with('sent', true);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

}
