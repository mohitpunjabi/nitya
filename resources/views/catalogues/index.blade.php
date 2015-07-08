@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <br/>
                <h1 class="page-header">All catalogues</h1>
                    <ul class="list-unstyled">
                        @foreach($catalogues as $catalogue)
                            <li>
                                <h3 class="media-heading">{{ $catalogue->name }}</h3>
                                <p>Share Link: <a href="{{ url($catalogue->access_key) }}">{{  url($catalogue->access_key) }}</a></p>
                                <div class="row">
                                    @foreach($catalogue->products as $product)
                                        <div class="col-sm-2">
                                            @include('products.partials.thumbnail', ['product' => $product, 'small' => true])
                                        </div>
                                    @endforeach
                                </div>

                                <hr/>
                            </li>
                        @endforeach
                    </ul>
                <br/>
            </div>
        </div>
    </div>
@endsection