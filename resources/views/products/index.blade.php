@extends('app')

@section('content')
    <div class="jumbotron jumbotron-sm" >
        <div class="container">
            <h1 class="text-center">Our products</h1>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <p class="text-center lead">We work hard towards differentiating our products from the market and providing our customers some fresh prints and designs every week. </p>
                    <p class="text-center">If you need more details about any of them, please send an enquiry.</p>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row product-grid">
            @foreach($products as $product)
                <div class="col-sm-6 col-md-3">
                    @include('products.partials.thumbnail', ['product' => $product])
                </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-md-6 col-md-offset-3 col-sm-12">
                <a href="{{ url('more') }}" class="btn btn-block btn-lg btn-primary">
                    <h2><i class="glyphicon glyphicon-plus"></i> More</h2>
                </a>
            </div>
        </div>
        <br/><br/>

    </div>
@endsection