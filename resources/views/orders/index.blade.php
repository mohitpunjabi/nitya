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
                                <div>
                                    Tracking ID: <strong>{{ $order->tracking_id }}</strong><br>
                                    <a href="{{ $order->link }}"><small>{{ $order->link }}</small></a>
                                </div>
                                <h2 class="media-heading"><small><i class="fa fa-inr"></i></small>{{ number_format($order->amount) }}</h2>
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