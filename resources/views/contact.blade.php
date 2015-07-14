@extends('app', [
    'title' =>(($title)? $title: 'Reach out to us')
])

@section('content')

    <div class="jumbotron jumbotron-sm">
        <div class="row">
            <h1 class="text-center">{{ $title or 'Reach out to us' }}</h1>
            <div class="col-md-8 col-md-offset-2">
                <p class="text-center lead">{{ $subtitle or '' }}</p>

                <div class="row text-center">
                    <div class="col-sm-4">
                        <h2>Call us at</h2>
                        <p class="lead">@include('partials.phone')</p>
                    </div>
                    <div class="col-sm-4">
                        <h2>Mail us at</h2>
                        <p class="lead">@include('partials.email')</p>
                    </div>

                    <div class="col-sm-4">
                        <h2>Visit us at</h2>
                        @include('partials.address')
                    </div>

                </div>

                @if($showMap)
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1778.753091362584!2d75.82467900000002!3d26.919163!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396db40b8621fc49%3A0x83d5ac3f3306edad!2sNitya+-+Eternal+Fashion%2C+132%2C+Pitaliyon+Ka+Chowk+Johari+Bazar%2C+Jaipur%2C+Rajasthan+302003!5e0!3m2!1sen!2sin!4v1436886358710" width="100%" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>
                @endif

            </div>
        </div>
    </div>

    <div class="container" id="write-to-us">
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
                        <p class="lead">
                            If you have any queries or feedback for us, please fill out the details below.
                        </p>
                        @include('enquiries.partials.form')
                    @endif
                </div>
            </div>
        </div>
    </div>

    <br/><br/>
@endsection