<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@unless(isset($title) && $title != '') Nitya - Eternal Fashion | Manufacturers and wholesalers of kurtis @else {{ $title }} | Nitya - Eternal Fashion @endif</title>

    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $metaDescription or 'Manufacturers and wholesalers of Jaipuri kurtis, Cotton kurtis, Palazzos, indian women\'s clothing and dress material' }}" />
    <meta name="revisit-after" content="2 days">
    <meta name="language" content="english" />
    <meta name="robots" content="{{ (isset($noIndex))? 'noindex, nofollow': 'index, follow'  }}" />
    <meta name="author" content="{{ $author or 'Nitya - Eternal Fashion' }}" />
    <meta property="og:image" content="{{ $ogImage or asset('img/default-og-image.jpg') }}"/>
    <meta property="og:title" content="@if(isset($title)) {{ $title }} | @endif Nitya - Eternal Fashion" />
    <meta property="og:description" content="{{ $metaDescription or '' }}" />
    <meta property="og:url" content="{{ Request::url() }}"/>
    <meta property="og:site_name" content="Nitya - Eternal Fashion"/>

    @yield('meta', '')

    <link rel="icon" type="image/ico" href="{{ asset('favicon.png') }}" />
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">
    <link href="https://plus.google.com/+NityaEternalFashionJaipur" rel="publisher" />
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

    <style type="text/css" media="print"> @page { size: auto; } </style>
</head>
<body>

<div id="fb-root"></div>

<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '1634783170140278',
            xfbml      : true,
            version    : 'v2.4'
        });
    };
    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

    @include('partials.navbar')

	@yield('content')


    <div class="bg-primary hidden-print">
        <div class="container">
            <div class="text-center text-lg" style="padding: 20px">
                For bulk orders and enquiries, <a href="{{ url('/contact') }}#write-to-us">write to us</a> or contact us at @include('partials.mobiles') or <a href="#">@include('partials.email')</a>
            </div>
        </div>
    </div>

    <footer class="hidden-print">
        <div class="container" itemscope itemtype="http://schema.org/Organization">
            <div class="col-md-6">
                <h3>About Nitya</h3>
                <p itemprop="description">
                    We are manufacturers and wholesalers of women's clothing based out of Jaipur. We focus on manufacturing a wide range of wholesale fashion clothing including
                    Jaipuri kurtis, Cotton kurtis, Rayon kurtis, Embroidered kurtis, Palazzos, Indian Women's Clothing and dress material.
                    <br/>
                    We started in December 2014 with a strong focus on fits, quality and customer experience. We offer wearable wholesale fashion at pocket-friendly prices.
                </p>
                <p>
                    Our vision is to change the local to global by bringing Jaipuri prints and embroidery to the world with trending fashion.
                </p>
                <p>
                <div class="fb-like" data-href="https://facebook.com/nityajaipur" style="max-width: 100%; overflow: hidden" data-layout="standard" data-colorscheme="dark" data-action="like" data-show-faces="true" data-share="true"></div>
                </p>
            </div>

            <div class="col-md-6">
                <meta itemprop="url" content="http://www.nityajaipur.com"/>
                <h3>Contact Us</h3>
                <p class="small">Nitya is operated under license by Super Sales Agency having its registered office at:</p>
                <p>
                    @include('partials.address')
                    <strong>Ph:</strong> @include('partials.phone'), @include('partials.mobiles') <br/>
                    <strong>Email:</strong> @include('partials.email')
                </p>
                <p>
                    <a itemprop="sameAs" class="btn btn-default btn-xs" href="https://www.facebook.com/nityajaipur" target="_blank">Facebook</a>
                    <a itemprop="sameAs" class="btn btn-default btn-xs" href="https://google.com/+NityaEternalFashionJaipur" target="_blank">Google+</a>
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