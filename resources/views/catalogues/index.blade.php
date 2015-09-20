@extends('app', [
    'noIndex' => true
])

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
                                            {{ $catalogue->link }}

                                            @unless($catalogue->name == 'public')
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['catalogues.destroy', $catalogue], 'class' => 'pull-right']) !!}
                                                <button onclick="return confirm('This cannot be undone. Continue?')" id="deleteBtn" class="btn btn-danger btn-xs" type="submit" title="Delete the catalogue">
                                                    <i class="glyphicon glyphicon-remove"></i> Delete
                                                </button>
                                                {!! Form::close() !!}
                                            @endunless
                                        </div>
                                        </h3>
                                    </div>

                                    <div class="panel-body">
                                        @if($catalogue->products->isEmpty())
                                            <p>There are no products in this catalogue.</p>
                                        @endif
                                        @foreach($catalogue->products->slice(0, 5) as $product)
                                            <div class="col-sm-2">
                                                @include('products.partials.thumbnail', ['product' => $product, 'small' => true])
                                            </div>
                                        @endforeach
                                        <div class="col-sm-2">
                                            @unless($catalogue->products->isEmpty())
                                                <a class="btn btn-block btn-default" href="{{ url('catalogues/' . $catalogue->id) }}">
                                                    {{ (($catalogue->products->count() > 5)? ('+ ' . ($catalogue->products->count() - 5) . ' More'): 'View All') }}
                                                </a>
                                            @endunless
                                            <a class="btn btn-block btn-primary" href="{{ url('catalogues/' . $catalogue->id) }}">Add</a>
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