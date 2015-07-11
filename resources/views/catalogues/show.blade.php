@extends('app')

@section('content')
    <div class="jumbotron jumbotron-sm" >
        <div class="container">
            <h1 class="text-center">{{ $catalogue->name }}</h1>
            <div class="row">
                <p class="lead text-center">
                    <span class="label label-default text-lg">{{ $catalogue->link }}</span>
                </p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
                {!! Form::open(['url' => 'catalogues/' . $catalogue->id . '/add']) !!}
                <div>
                    {!! Form::select('products[]', [], null, ['class' => 'product-select2 form-control input-lg']) !!}
                    <label class="help-block"></label>
                    @if($errors->first('products')) <div class="alert alert-danger">{{ $errors->first('products') }}</div> @endif
                </div>
                <div>
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Add</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <br/><br/>
        <div class="row product-grid">
            @foreach($catalogue->products as $product)
                <div class="col-sm-6 col-md-3">
                    @include('products.partials.thumbnail', ['product' => $product, 'currentCatalogue' => $catalogue])
                </div>
            @endforeach
        </div>

        <br/><br/>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function() {
            $('.product-select2').productSelect2({
                placeholder: 'Add more products'
            });
        });
    </script>
@endsection