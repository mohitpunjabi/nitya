@extends('app')

@section('content')
    <div class="jumbotron" style="background-image: url('{{ asset('img/jumbo1.jpg') }}')">
        <div class="container">
            <h1>Nitya</h1>
            <h3>Eternal Fashion</h3>
            <p class="lead">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            </p>
            <p>
                <a href="{{ url('products') }}" class="btn btn-lg btn-primary">Browse our products</a>
            </p>

        </div>

    </div>

    <div class="container">
        <h2 class="text-center">About Us</h2>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <p class="text-center lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed venenatis pulvinar hendrerit. Quisque metus urna, sollicitudin in quam id, ornare fringilla dolor.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <h3>Manufacturers of kurtis and dress material</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed venenatis pulvinar hendrerit. Morbi metus leo, maximus eget pellentesque vel, tempus eget libero. Proin volutpat erat nec arcu convallis, ac tincidunt massa ultricies. Ut vestibulum mauris sagittis malesuada rhoncus. Quisque metus urna, sollicitudin in quam id, ornare fringilla dolor.</p>
            </div>
            <div class="col-md-4">
                <h3>Quality AND Quantity</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed venenatis pulvinar hendrerit. Morbi metus leo, maximus eget pellentesque vel, tempus eget libero. Proin volutpat erat nec arcu convallis, ac tincidunt massa ultricies. Ut vestibulum mauris sagittis malesuada rhoncus. Quisque metus urna, sollicitudin in quam id, ornare fringilla dolor.</p>
            </div>
            <div class="col-md-4">
                <h3>Eternal Fashion</h3>
                <p>Lorem ipsum dolor sit amet. Sed venenatis pulvinar hendrerit. Morbi metus leo, maximus eget pellentesque vel, tempus eget libero. Proin volutpat erat nec arcu convallis, ac tincidunt massa ultricies. Ut vestibulum mauris sagittis malesuada rhoncus. Quisque metus urna, sollicitudin in quam id, ornare fringilla dolor.</p>
            </div>
        </div>

        <div class="row">
            <h2 class="text-center">Latest Products</h2>
            <div class="col-md-8 col-md-offset-2">
                <p class="text-center lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
        </div>
        <div class="row product-grid">

        @foreach($products as $product)
            <div class="col-sm-6 col-md-3">
                @include('products.partials.thumbnail', $product)
            </div>
        @endforeach

        </div>
    </div>
@endsection