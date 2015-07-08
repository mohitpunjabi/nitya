@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <br/>
                <h1 class="page-header">Create a product</h1>
                {!! Form::open(['route' => 'products.store', 'files' => true]) !!}

                @include('products.partials.form', ['buttonText' => 'Create'])

                {!! Form::close() !!}
                <br/>
            </div>
        </div>
    </div>
@endsection