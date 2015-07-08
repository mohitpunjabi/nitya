@extends('app')

@section('content')
    <div class="col-md-8 col-md-offset-2">
        <h1 class="page-header">Create a product</h1>
        {!! Form::model($product, ['method' => 'PATCH', 'route' => ['products.update', $product], 'files' => true]) !!}

        @include('products.partials.form', ['buttonText' => 'Update'])

        {!! Form::close() !!}
    </div>
@endsection