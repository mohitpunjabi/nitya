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
		$enquiries = $this->getEnquiries(false);
        return view('enquiries.index', compact('enquiries'));
	}

    public function read()
    {
        $enquiries = $this->getEnquiries(true);
        $showingRead = true;
        return view('enquiries.index', compact('enquiries', 'showingRead'));
    }

    private function getEnquiries($trashed) {
        $enquiries = Enquiry::with(['product' => function($query) {
            $query->with('images');
        }]);
        if($trashed) $enquiries = $enquiries->withTrashed();

        return $enquiries->latest()->paginate(20);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param Enquiry $enquiry
     * @return Response
     * @throws \Exception
     * @internal param int $id
     */
    public function destroy($id)
    {
        $enquiry = Enquiry::withTrashed()->findOrFail($id);
        if($enquiry->trashed()) $enquiry->restore();
        else                    $enquiry->delete();
        return redirect()->back();
    }


}
