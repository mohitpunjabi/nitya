@extends('app', [
    'noIndex' => true
])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <br/>
                <h1 class="page-header">Edit order #{{ $order->tracking_id }}</h1>
                {!! Form::model($order, ['method' => 'PATCH', 'route' => ['orders.update', $order]]) !!}

                @include('orders.partials.form', ['buttonText' => 'Update Order'])

                {!! Form::close() !!}
                <br/>
            </div>
        </div>
    </div>
@endsection