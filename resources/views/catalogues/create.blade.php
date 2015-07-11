@extends('app', [
    'noIndex' => true
])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <br/>
                <h1 class="page-header">Create a catalogue</h1>
                {!! Form::open(['route' => 'catalogues.store']) !!}

                    <div>
                        {!! Form::label('name', 'Catalogue Name') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Catalogue Name']) !!}
                        <label class="help-block">Name of the catalogue (will not be shown to anyone)</label>
                        @if($errors->first('name')) <div class="alert alert-danger">{{ $errors->first('name') }}</div> @endif
                    </div>

                    <div>
                        <button class="btn btn-block btn-primary" type="submit">Create</button>
                    </div>

                {!! Form::close() !!}
                <br/>
            </div>
        </div>
    </div>
@endsection