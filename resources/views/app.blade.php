<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ $title or 'Manufacturers and wholesalers of Jaipuri kurtis and dress material' }} | Nitya - Eternal Fashion</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $metaDescription or 'Manufacturers and wholesalers of Jaipuri kurtis, Cotton kurtis, Palazzos, indian women\'s clothing and dress material' }}" />
    <meta name="revisit-after" content="2 days">
    <meta name="language" content="english" />
    <meta name="robots" content="{{ (isset($noIndex))? 'noindex, nofollow': 'index, follow'  }}" />
    <meta name="author" content="{{ $author or 'Nitya - Eternal Fashion' }}" />
    <meta property="og:image" content="{{ $ogImage or asset('img/default-og-image.jpg') }}"/>
    <meta property="og:title" content="{{ $title or 'Nitya - Eternal Fashion' }}" />
    <meta property="og:description" content="{{ $metaDescription or '' }}" />
    <meta property="og:url" content="{{ Request::url() }}"/>
    <meta property="og:site_name" content="Nitya - Eternal Fashion"/>

    @yield('meta', '')

    <link rel="icon" type="image/ico" href="{{ asset('favicon.png') }}" />
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">
    <link href="https://plus.google.com/105229227002561113902" rel="publisher" />
	<!-- Fonts -->
	<!-- <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'> -->

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

    <script type="text/javascript" async defer
            src="https://apis.google.com/js/platform.js?publisherid=105229227002561113902">
    </script>
</head>
<body>
    @include('partials.navbar')

	@yield('content')


    <div class="bg-primary">
        <div class="container">
            <div class="text-center text-lg" style="padding: 20px">
                For bulk orders and enquiries, <a href="{{ url('/contact') }}#write-to-us">write to us</a> or contact us at @include('partials.mobiles') or <a href="#">@include('partials.email')</a>
            </div>
        </div>
    </div>

    <footer>
        <div class="container" itemscope itemtype="http://schema.org/Organization">
            <div class="col-md-6">
                <h3>About Nitya</h3>
                <p itemprop="description">
                    Nitya – Eternal Fashion is a premium lifestyle apparel brand for women that started in December 2014 with a strong focus on fits, quality and customer experience. We offer wearable fashion at pocket-friendly prices.
                </p>
                <p>
                    Our vision is to change the local to global by bringing Jaipuri prints and embroidery to the world with trending fashion.
                </p>
            </div>

            <div class="col-md-6">
                <meta itemprop="url" content="http://www.nityajaipur.com"/>
                <meta itemprop="sameAs" content="https://plus.google.com/105229227002561113902"/>
                <h3>Contact Us</h3>
                <p class="small">Nitya is operated under license by Super Sales Agency having its registered office at:</p>
                <p>
                    @include('partials.address')
                </p>
                <p>
                    Ph: @include('partials.phone'), @include('partials.mobiles') <br/>
                    Email: @include('partials.email')
                </p>
            </div>
        </div>
    </footer>

	<!-- Scripts -->
    <script type="text/javascript">
        function url(path) {
            if(path.charAt(0) == '/') path = path.substr(1);
            return '{{ url() }}' + '/' + path;
        }
    </script>
    <script src="{{ elixir('js/app.js') }}"></script>


    @yield('script', '')
</body>
</html>