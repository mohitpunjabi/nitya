@extends('app', [
    'title' =>(isset($title)? $title: 'Contact us'),
    'metaDescription' => 'For bulk orders and enquiries, contact us at +91 9660009899, visit us at 132 Pitaliyon ka Chowk, Johari Bazar, Jaipur.'
])

@section('content')

    <div class="jumbotron jumbotron-sm">
        <div class="container">
            <div class="row">
                <h1 class="text-center">{{ $title or 'Reach out to us' }}</h1>
                <div class="col-md-10 col-md-offset-1">
                    <p class="text-center lead">{{ $subtitle or '' }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container" id="write-to-us">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @if($showMap)
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1778.753091362584!2d75.82467900000002!3d26.919163!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396db40b8621fc49%3A0x83d5ac3f3306edad!2sNitya+-+Eternal+Fashion%2C+132%2C+Pitaliyon+Ka+Chowk+Johari+Bazar%2C+Jaipur%2C+Rajasthan+302003!5e0!3m2!1sen!2sin!4v1436886358710" width="100%" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>
                    <br/><br/>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 col-md-offset-1 text-center">
                <br/>
                <div class="row text-center">
                    <div class="col-md-12 col-sm-6">
                        <div class="fb-page hidden-xs" data-href="https://www.facebook.com/nityajaipur" data-width="500" data-height="220" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false">
                            <div class="fb-xfbml-parse-ignore">
                                <blockquote cite="https://www.facebook.com/nityajaipur">
                                    <a href="https://www.facebook.com/nityajaipur">Nitya - Eternal Fashion</a>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-6">
                        <div class="well well-sm">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h3>Call us at</h3>
                                    <p><span class="label label-default text-lg">@include('partials.phone')</span></p>
                                </div>
                                <div class="col-sm-12">
                                    <h3>Mail us at</h3>
                                    <p class="lead"><span class="label label-default text-lg">@include('partials.email')</span></p>
                                </div>
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-xs-5 col-xs-offset-1">
                                            <div class="fb-like" data-href="https://facebook.com/nityajaipur" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
                                        </div>
                                        <div class="col-xs-5">
                                            <div class="g-follow" data-href="https://plus.google.com/+NityaEternalFashionJaipur" data-rel="publisher"></div>
                                        </div>
                                    </div>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="enquiry-form-large text-center">
                    @if(Session::has('sent'))
                        <div class="alert alert-success">
                            <h3>Thank you for contacting us</h3>
                            <p>Your enquiry has been sent. We will get back to you as soon as we can.</p>
                        </div>
                    @else
                        <h2>Write to us</h2>
                        <p class="lead">
                            If you have any queries or feedback for us, please fill out the details below.
                        </p>
                        @include('enquiries.partials.form')
                    @endif
                </div>
            </div>
        </div>
    </div>
    <br/>
@endsection


@section('script')

<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [{
    "@type": "ListItem",
    "position": 1,
    "item": {
      "@id": "{{ url() }}",
      "name": "Home"
    }
  },{
    "@type": "ListItem",
    "position": 2,
    "item": {
      "@id": "{{ url('contact') }}",
      "name": "Contact"
    }
  }]
}
</script>
@endsection