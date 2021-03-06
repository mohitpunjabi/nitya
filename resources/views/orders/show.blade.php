@extends('app', [
    'title'           => 'Order #' . $order->tracking_id,
    'noIndex'         => true
])

@section('content')
    <div class="container printable-invoice">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <br/>
                <div class="row">
                    <div class="col-xs-6">
                        <img width="60" src="{{ asset('img/nitya-logo.png') }}" alt="Nitya - Eternal Fashion" />
                    </div>
                    <div class="col-xs-6" align="right">
                        <h1 class="media-heading">
                            <small>Order #</small>{{ $order->tracking_id }}
                        </h1>
                        <small>{{ $order->created_at->toFormattedDateString() }}</small>
                    </div>
                </div>
                <br/>

                <p class="small" style="border-bottom: 1px #DDD solid">
                    <i class="glyphicon glyphicon-globe"></i> {{ url() }} |
                    <i class="glyphicon glyphicon-envelope"></i> @include('partials.email') |
                    <i class="glyphicon glyphicon-phone"></i> @include('partials.phone'), @include('partials.mobiles')
                </p>

                <div class="row">
                @if($order->billing_name)
                    <div class="col-sm-7">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Shipping Details
                            </div>
                            <div class="panel-body">
                                <strong>{{ $order->billing_name }}</strong><br>
                                @if($order->billing_address)
                                <p>
                                    {{ $order->billing_address }}
                                </p>
                                @endif
                                @if($order->billing_email)
                                    <strong>Email:</strong> <span>{{ $order->billing_email }}</span><br/>
                                @endif
                                @if($order->billing_contact)
                                    <strong>Contact:</strong> <span>{{ $order->billing_contact }}</span><br/>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
                    <div class="col-sm-5">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Order Summary
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-6 text-right">
                                        <strong>Total items</strong>
                                    </div>
                                    <div class="col-xs-6">
                                        <strong>{{ number_format($order->total_quantity) }}</strong>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 text-right">
                                        Subtotal
                                    </div>
                                    <div class="col-xs-6">
                                        <span>&#8377;{{ number_format($order->amount - $order->shipping_charges) }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 text-right">
                                        Shipping charges
                                    </div>
                                    <div class="col-xs-6">
                                        <span>&#8377;{{ number_format($order->shipping_charges) }}</span>
                                    </div>
                                </div>

                                @if($order->tax)
                                <div class="row">
                                    <div class="col-xs-6 text-right">
                                        Tax
                                    </div>
                                    <div class="col-xs-6">
                                        <span>&#8377;{{ number_format($order->tax) }}</span>
                                    </div>
                                </div>
                                @endif
                                
                                <div class="row">
                                    <div class="col-xs-6 text-right">
                                        <strong class="text-lg">Total</strong>
                                    </div>
                                    <div class="col-xs-6">
                                        <span>&#8377;</span><strong class="text-lg" id="grandTotal">{{ number_format($order->amount) }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Order details</div>

                            <table class="table table-hover table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th>Item</th>
                                        <th width="17%">Rate</th>
                                        <th width="17%">Quantity</th>
                                        <th width="17%" style="text-align: right">Amount</th>
                                    </tr>
                                </thead>

                                <tbody>
                                <?php $sNo = 1; ?>
                                @foreach($order->products as $product)
                                    <tr>
                                        <td><span class="text-lg">{{ $sNo++ }}</span></td>
                                        <td>
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="{{ url_product($product) }}">
                                                        <img height="42" src="{{ $product->images[0]->path('xs') }}" alt="{{ $product->name }}"/>
                                                    </a>
                                                </div>

                                                <div class="media-body">
                                                    <a style="color: #000" href="{{ url_product($product) }}">
                                                        <strong>{{ $product->name }}</strong><br/>
                                                        <span class="text-muted">ID {{ $product->design_no }}</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span>&#8377;</span><span class="text-lg">{{ number_format($product->pivot->unit_price) }}</span>
                                        </td>
                                        <td>
                                            <span class="text-lg">{{ number_format($product->pivot->quantity) }}</span>
                                        </td>
                                        <td align="right">
                                            <span>&#8377;</span><span class="text-lg">{{ number_format($product->pivot->quantity * $product->pivot->unit_price) }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                                <tfoot>
                                    <tr style="border-top: 2px #AAA solid">
                                        <td colspan="3"></td>
                                        <td>
                                            <span class="text-lg">{{ number_format($order->total_quantity) }}</span>
                                        </td>
                                        <td align="right">
                                            <span>&#8377;</span><span class="text-lg">{{ number_format($order->amount - $order->shipping_charges - $order->tax) }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" align="right"><strong>Shipping Charges</strong></td>
                                        <td align="right">
                                            <span>&#8377;</span>{{ number_format($order->shipping_charges) }}
                                        </td>
                                    </tr>
                                    @if($order->tax > 0)
                                        <tr>
                                            <td colspan="4" align="right"><strong>Tax</strong></td>
                                            <td align="right">
                                                <span>&#8377;</span>{{ number_format($order->tax) }}
                                            </td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td colspan="4" align="right"><strong class="text-lg">Total</strong></td>
                                        <td align="right">
                                            <span>&#8377;</span><strong class="text-lg" id="grandTotal">{{ number_format($order->amount) }}</strong>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row hidden-print">
                    <div class="col-md-12">
                        <p align="right">
                            <button id="print" class="btn btn-primary">Print</button>
                            @if(Auth::user())
                                <a class="btn btn-warning" href="{{ route('orders.edit', $order) }}">Edit</a>
                                <button class="btn btn-default">Email</button>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function() {
            $('#print').click(function() {
                window.print();
            });
        });
    </script>
@endsection