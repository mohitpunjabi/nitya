<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Nitya - Eternal Fashion</title>

    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">

	<!-- Fonts -->
	<!-- <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'> -->

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Nitya</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url('/about') }}">About</a></li>
                    <li><a href="{{ url('/products') }}">Products</a></li>
                    <li><a href="{{ url('/contact') }}">Contact Us</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Login</a></li>
<!--						<li><a href="{{ url('/auth/register') }}">Register</a></li> -->
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	@yield('content')


    <div class="bg-primary">
        <div class="container">
            <div class="text-center text-lg" style="padding: 20px">
                For bulk orders and enquiries, <a href="#">write to us</a> or contact us at +91 96600091899 or <a href="#">info@nityajaipur.com</a>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="col-md-4">
                <h3>About Nitya</h3>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed venenatis pulvinar hendrerit. Morbi metus leo, maximus eget pellentesque vel, tempus eget libero. Proin volutpat erat nec arcu convallis, ac tincidunt massa ultricies. Ut vestibulum mauris sagittis malesuada rhoncus. Quisque metus urna, sollicitudin in quam id, ornare fringilla dolor. Cras eleifend, ante id consequat facilisis, dui ligula convallis libero, quis rutrum urna ipsum sed nisl. Fusce non arcu fermentum, imperdiet lorem ut, condimentum velit.
                </p>
            </div>

            <div class="col-md-4">
                <h3>Contact Us</h3>
            </div>
        </div>
    </footer>

	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="{{ elixir('js/app.js') }}"></script>
</body>
</html>