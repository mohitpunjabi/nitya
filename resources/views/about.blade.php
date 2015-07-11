@extends('app', [
    'title' => 'About Us'
])

@section('content')
    <div class="jumbotron jumbotron-sm">
        <h1 class="text-center">About Us</h1>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <p class="text-center lead">
                    Our vision is to change the local to global by bringing Jaipuri prints and embroidery to the world with trending fashion.
                </p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 pull-right">
                <img class="img img-responsive" src="{{ asset('img/eternal-style.jpg') }}" alt=""/>
            </div>
            <div class="col-md-4 col-sm-6 col-md-offset-1">
                <h1 class="text-center section-heading">Eternal Style. Eternal Fashion.</h1>
                <p class="lead"><strong>Nitya – Eternal Fashion</strong> is a premium lifestyle apparel brand for women that started in December 2014 with a strong focus on fits, quality and customer experience. We offer wearable fashion at pocket-friendly prices.</p>
                <p class="lead">
                    Our vision is to change the local to global by bringing Jaipuri prints and embroidery to the world with trending fashion.
                </p>
                <p class="lead">Our products range from Cotton Kurtis, Embroidered Dress Material, Gota Patti Work, Pallazos, etc.</p>
            </div>
        </div>
        <br/>

        <div class="row">
            <div class="col-md-6 col-sm-12 col-md-offset-1">
                <img class="img img-responsive" src="{{ asset('img/gota-patti-quality.jpg') }}" alt=""/>
            </div>
            <div class="col-md-4 col-sm-12">
                <h1 class="text-center section-heading">Committed to quality</h1>
                <p class="lead">At Nitya, our focus remains on using the highest quality materials and providing finest finished products. We work hard towards differentiating our products from the market and providing our customers some fresh prints and designs every week. </p>
            </div>
        </div>
        <br/>

    </div>
    <br/>
    <br/>
@endsection