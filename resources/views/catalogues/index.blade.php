@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <br/>
                <h1 class="page-header">All catalogues</h1>

                    <div class="row">
                        @foreach($catalogues as $catalogue)
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3>{{ $catalogue->name }}
                                        <div class="pull-right">
                                            {{ url($catalogue->access_key) }}
                                        </div>
                                        </h3>
                                    </div>

                                    <div class="panel-body">
                                        @foreach($catalogue->products->slice(0, 5) as $product)
                                            <div class="col-sm-2">
                                                @include('products.partials.thumbnail', ['product' => $product, 'small' => true])
                                            </div>
                                        @endforeach
                                        <div class="col-sm-2">
                                            <a class="btn btn-block btn-default" href="{{ url('catalogues/' . $catalogue->id) }}">View All</a>
                                            <a class="btn btn-block btn-primary" href="{{ url('catalogues/' . $catalogue->id) }}">Add More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                <br/>
            </div>
        </div>
    </div>
@endsection