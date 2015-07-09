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
                    @if(Session::has('sent'))
                        <div class="alert alert-success">
                            <h3>Thank you for contacting us</h3>
                            <p>Your enquiry has been sent. We will get back to you as soon as we can.</p>
                        </div>
                    @else
                        <h1>Write to us</h1>
                        @include('enquiries.partials.form')
                    @endif
                </div>
            </div>
        </div>
    </div>

    <br/><br/>
@endsection