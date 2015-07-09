@extends('app')

@section('content')

    <div class="jumbotron jumbotron-sm">
        <div class="row">
            <h1 class="text-center">Need more products?</h1>
            <p class="text-center lead">To view more products, place an order or get price details, please reach out to us.</p>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-1">
                <div class="enquiry-form-large text-center">
                    <h2>Write to us</h2>
                    <p class="lead">Fill out your contact details, and we shall get back to you.</p>
                    {!! Form::open(['route' => 'enquiries.store']) !!}
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
                        {!! Form::text('contact', null, ['class' => 'form-control input-lg', 'placeholder' => 'Contact Number']) !!}
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

                    {!! Form::close() !!}
                </div>
            </div>

            <div class="col-md-4 text-center">
                <div class="row">
                    <div>
                        <h3 class="media-heading">Call us at</h3>
                        <p class="text-lg">+91 141 2542342</p>
                    </div>
                    <div>
                        <h3 class="media-heading">Mail us at</h3>
                        <p class="text-lg">info@nityajaipur.com</p>
                    </div>

                    <div>
                        <h3 class="media-heading">Visit us at</h3>

                        <address>
                            <strong>SUPER SALES AGENCY</strong><br/>
                            132 Pitaliyon Ka Chowk, Johari Bazaar,<br/>
                            Jaipur - 302002, Rajasthan <br/>
                        </address>

                    </div>
                </div>

            </div>

        </div>
    </div>

    <br/><br/>
@endsection