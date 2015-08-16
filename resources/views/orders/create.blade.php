@extends('app', [
    'noIndex' => true
])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <br/>
                <h1 class="page-header">Create an order</h1>
                {!! Form::open(['route' => 'orders.store']) !!}

                @include('orders.partials.form', ['buttonText' => 'Create Order'])

                {!! Form::close() !!}
                <br/>
            </div>
        </div>
    </div>
@endsection