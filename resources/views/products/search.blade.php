@extends('app', [
    'title' => ((isset($query) and $query != '')? 'Search results for "' . $query. '"': 'Search for something'),
    'metaDescription' => 'Search for our products. Kurtis, Jaipuri kurtis, chanderi, rayon kurtis, cotton kurtis, palazzos, jaipuri prints and more.'
])

@section('content')
    <div class="jumbotron jumbotron-sm" >
        <div class="container">
            <h1 class="text-center">Our products</h1>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    {!! Form::open(['method' => 'GET', 'url' => 'search']) !!}
                    <div class="input-group input-group-lg">
                        <input type="text" class="form-control" name="q" value="{{ $query or '' }}" placeholder="Search for ..." required="required">
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                        </span>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <p class="text-center lead">
                @if(isset($query) && $query != "")
                    Found {{ $products->count() }} @if($products->count() > 1) products @else product @endif matching <strong><em>"{{ $query }}"</em></strong>
                @else
                    Search for a product.
                @endif
            </p>
        </div>
        <div class="row product-grid">
            @foreach($products as $product)
                <div class="col-sm-6 col-md-3">
                    @include('products.partials.thumbnail', ['product' => $product])
                </div>
            @endforeach
        </div>

        @if(!$products->isEmpty())
        <div class="row">
            <div class="col-md-6 col-md-offset-3 col-sm-12">
                <a href="{{ url('more') }}" class="btn btn-block btn-lg btn-primary">
                    <h2><i class="glyphicon glyphicon-plus"></i> More</h2>
                </a>
            </div>
        </div>
        <br/><br/>
        @endif

    </div>
@endsection