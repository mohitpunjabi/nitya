@extends('app', [
    'noIndex' => true
])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <br/>
                <h1 class="page-header">
                    All Orders
                </h1>

                @if($orders->isEmpty())
                    There are no orders to show. <a class="btn btn-default" href="{{ url('orders/create') }}">Create an order</a>.
                @endif

                @foreach($orders as $order)
                    <div class="well well-sm">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="small">
                                    <strong>{{ $order->billing_name or ''}}</strong><br/>
                                    <span>{{ $order->billing_email or ''}}</span><br/>
                                    {{ $order->billing_contact }}<br/>
                                    {{ $order->billing_address or ''}}<br/>
                                </p>
                            </div>
                            <div class="col-sm-9">
                                <div class="pull-right">
                                    <strong>{{ $order->created_at->toFormattedDateString() }}</strong><br>
                                    <a class="btn btn-block btn-warning" href="{{ route('orders.edit', $order) }}">Edit</a>
                                </div>
                                <div>
                                    Tracking ID: <strong>{{ $order->tracking_id }}</strong><br>
                                    <a href="{{ $order->link }}"><small>{{ $order->link }}</small></a>
                                </div>
                                <h2 class="media-heading"><small><span>&#8377;</span></small>{{ number_format($order->amount) }}</h2>
                                <div>
                                    @foreach($order->products->slice(0, 5) as $product)
                                        <a href="{{ url_product($product) }}">
                                            <span class="label label-info">
                                                <strong>{{ $product->design_no }}</strong> x {{ $product->pivot->quantity }}
                                            </span>
                                        </a>
                                        &nbsp;
                                    @endforeach
                                    <a class="small" href="{{ url('orders/' . $order->id) }}">
                                        {{ (($order->products->count() > 5)? ('... and ' . ($order->products->count() - 5) . ' More'): 'View Details') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <br/>

            </div>
        </div>
    </div>
@endsection