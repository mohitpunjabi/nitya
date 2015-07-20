@extends('app', [
    'noIndex' => true
])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <br/>
                <h1 class="page-header">Edit the product
                    {!! Form::open(['method' => 'DELETE', 'route' => ['products.destroy', $product], 'class' => 'pull-right']) !!}
                        <button onclick="return confirm('Are you sure you want to delete this product? This cannot be undone.')" class="btn btn-danger" type="submit">&times; Delete this product</button>
                    {!! Form::close() !!}
                </h1>
                {!! Form::model($product, ['method' => 'PATCH', 'route' => ['products.update', $product], 'files' => true]) !!}

                @include('products.partials.form', ['buttonText' => 'Update'])

                {!! Form::close() !!}
                <br/>
            </div>
        </div>
    </div>
@endsection