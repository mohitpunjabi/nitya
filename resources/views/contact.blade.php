@extends('app')

@section('content')

    <div class="jumbotron jumbotron-sm">
        <div class="row">
            <h1 class="text-center">{{ $title or 'Reach out to us' }}</h1>
            <div class="col-md-8 col-md-offset-2">
                <p class="text-center lead">{{ $subtitle or '' }}</p>

                <div class="row text-center">
                    <div class="col-sm-4">
                        <h2>Call us at</h2>
                        <p class="lead">+91 141 2542342</p>
                    </div>
                    <div class="col-sm-4">
                        <h2>Mail us at</h2>
                        <p class="lead">info@nityajaipur.com</p>
                    </div>

                    <div class="col-sm-4">
                        <h2>Visit us at</h2>

                        <address>
                            <strong>SUPER SALES AGENCY</strong><br/>
                            132 Pitaliyon Ka Chowk, Johari Bazaar,<br/>
                            Jaipur - 302002, Rajasthan <br/>
                        </address>

                    </div>

                </div>

                @if($showMap)
                    <img class="img img-responsive" src="{{ asset('img/nitya-map.png') }}" width="100%" >
                @endif

            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="enquiry-form-large text-center">
                    <h1>Write to us</h1>
                    <p class="lead">Fill out your contact details, and we shall get back to you.</p>
                    <div>
                        {!! Form::text('name', null, ['class' => 'form-control input-lg', 'placeholder' => 'Name']) !!}
                        <label class="help-block"></label>
                        @if($errors->first('name')) <div class="alert alert-danger">{{ $errors->first('name') }}</div> @endif
                    </div>
                    <div>
                        {!! Form::text('email', null, ['class' => 'form-control input-lg', 'placeholder' => 'Email Address']) !!}
                        <label class="help-block"></label>
                        @if($errors->first('email')) <div class="alert alert-danger">{{ $errors->first('email') }}</div> @endif
                    </div>
                    <div>
                        {!! Form::text('phone', null, ['class' => 'form-control input-lg', 'placeholder' => 'Contact Number']) !!}
                        <label class="help-block"></label>
                        @if($errors->first('phone')) <div class="alert alert-danger">{{ $errors->first('phone') }}</div> @endif
                    </div>
                    <div>
                        {!! Form::textarea('message', null, ['class' => 'form-control input-lg', 'placeholder' => 'Your message', 'rows' => 4]) !!}
                        <label class="help-block"></label>
                        @if($errors->first('message')) <div class="alert alert-danger">{{ $errors->first('message') }}</div> @endif
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <p>
                                <button class="btn btn-lg btn-block btn-primary" type="submit"><i class="glyphicon glyphicon-envelope"></i> Submit</button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br/><br/>
@endsection