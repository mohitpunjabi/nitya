<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\OrderRequest;
use App\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller {

    public function __construct() {
        $public = ['track'];
        $this->middleware('auth', ['except' => $public]);
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $orders = Order::with(['products'])->latest()->get();
		return view('orders.index', compact('orders'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('orders.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(OrderRequest $request)
	{
        $order = new Order($request->all());
        $order->tracking_id = mt_rand(100, 999999);
        $order->save();

        $this->attachProducts($order, $request);

        return redirect()->route('orders.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Order $order)
	{
        $order->load('products', 'products.images');
		return view('orders.show', compact('order'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Order $order)
	{
        return view('orders.edit', compact('order'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(OrderRequest $request, Order $order)
	{
        $order->update($request->all());
        $this->attachProducts($order, $request);

        return redirect()->route('orders.show', $order  );
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


    public function track($trackingId)
    {
        $order = Order::where('tracking_id', $trackingId)->firstOrFail();
        $order->load('products', 'products.images');
        return view('orders.show', compact('order'));
    }

    private function attachProducts($order, $request) {
        $products = $request->get('products');
        $unitPrices = $request->get('unit_prices');
        $quantities = $request->get('quantities');

        $order->products()->detach();
        foreach($products as $i => $id) {
            $order->products()->attach([$id => ['unit_price' => $unitPrices[$i], 'quantity' => $quantities[$i]]]);
        }
    }
}
