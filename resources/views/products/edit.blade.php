@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <br/>
                <h1 class="page-header">Edit the product</h1>
                {!! Form::model($product, ['method' => 'PATCH', 'route' => ['products.update', $product], 'files' => true]) !!}

                @include('products.partials.form', ['buttonText' => 'Update'])

                {!! Form::close() !!}
                <br/>
            </div>
        </div>
    </div>
@endsection