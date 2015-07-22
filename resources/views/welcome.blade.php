@extends('app', [
    'stickyNav' => true,
])

@section('content')
    <div class="jumbotron" style="background-image: url('{{ asset('img/jumbotron/jumbotron-img-1.jpg') }}')">
        <div class="container" itemscope itemtype="http://schema.org/Brand">
            <meta itemprop="name" content="Nitya - Eternal Fashion"/>
            <meta itemprop="sameAs" content="https://plus.google.com/105229227002561113902"/>
            <meta itemprop="sameAs" content="https://facebook.com/nityajaipur"/>
            <p>
                <img itemprop="logo" src="{{ asset('img/nitya-logo.png') }}" alt="Nitya - Eternal Fashion" title="Nitya - Eternal Fashion">
            </p>
            <p class="lead" itemprop="description">
                Manufacturers and Wholesalers of <br/>
                Cotton Kurtis, Dress Material and more.
            </p>
            <p>
                <a href="{{ url('products') }}" class="btn btn-lg btn-primary">Browse our products</a>
            </p>
        </div>
    </div>

    <div class="container">
        <h2 class="text-center">About Us</h2>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <p class="text-center lead">We bring traditional Jaipuri prints and embroidery to the world with trending fashion.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <h3>Eternal Style. Eternal Fashion.</h3>
                <p><strong>Nitya – Eternal Fashion</strong> is a premium lifestyle apparel brand for women that started in December 2014 with a strong focus on fits, quality and customer experience. We offer wearable fashion at pocket-friendly prices.</p>
                <p>Our vision is to change the local to global by bringing Jaipuri prints and embroidery to the world with trending fashion.</p>
            </div>
            <div class="col-md-4">
                <h3>Committed to quality</h3>
                <p>At Nitya, our focus remains on using the highest quality materials and providing finest finished products. We work hard towards differentiating our products from the market and providing our customers fresh prints and designs.</p>
                <p>Our products range from Cotton Kurtis, Embroidered Dress Material, Gota Patti Work, Pallazos, etc.</p>

            </div>
            <div class="col-md-4">
                <h3>Everything starts with the customer</h3>
                <p>We take our customer feedback seriously and work hard to ensure your experience with us is positive. We are always open to your ideas to develop something refreshingly new to add to our portfolio.</p>
                <p>If you have any feedback, please do <a href="{{ url('contact') }}#write-to-us">write to us</a>.</p>
            </div>
        </div>

        <br/>
        <div class="row">
            <h2 class="text-center">Latest Products</h2>
            <div class="col-md-8 col-md-offset-2">
                <p class="text-center lead">These are some of our latest trending products. <br/>
                <a href="{{ url('products') }}"> View all products &raquo;</a></p>
            </div>
        </div>
        <div class="row product-grid">
        @foreach($products as $product)
            <div class="col-sm-6 col-md-3">
                @include('products.partials.thumbnail', $product)
            </div>
        @endforeach
        </div>

        <div class="row">
            <div class="hidden-md hidden-lg hidden-sm col-xs-12">
                <a href="{{ url('products') }}" class="btn btn-block btn-lg btn-primary">
                    <h2><i class="glyphicon glyphicon-plus"></i> More</h2>
                </a>
                <br/><br/>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function() {
            var bgImages = [
                '/img/jumbotron/jumbotron-img-1.jpg',
                '/img/jumbotron/jumbotron-img-2.jpg',
                '/img/jumbotron/jumbotron-img-3.jpg'
            ];

            setTimeout(function() {
                $('.jumbotron').bgswitcher({
                    images: bgImages,
                    duration: 2000
                });
            }, 2000);

        });
    </script>
@endsection