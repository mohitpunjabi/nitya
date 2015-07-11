<nav class="navbar navbar-default navbar-fixed-top @if(isset($stickyNav) && $stickyNav) navbar-sticky @else navbar-solid @endif">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}" title="Nitya - Eternal Fashion">Nitya @if(Auth::user()) <small class="text-primary">- Admin Panel</small> @endif</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li itemscope itemtype="http://www.schema.org/SiteNavigationElement"><a href="{{ url('/') }}" title="Nitya - Eternal Fashion" itemprop="url"><span itemprop="name">Home</span></a></li>
                @if(Auth::guest())
                    <li itemscope itemtype="http://www.schema.org/SiteNavigationElement"><a href="{{ url('/about') }}" title="About Nitya" itemprop="url"><span itemprop="name">About</span></a></li>
                    <li itemscope itemtype="http://www.schema.org/SiteNavigationElement"><a href="{{ url('/products') }}" title="Our Products" itemprop="url"><span itemprop="name">Products</span></a></li>
                    <li itemscope itemtype="http://www.schema.org/SiteNavigationElement"><a href="{{ url('/contact') }}" title="For orders and enquires, contact us" itemprop="url"><span itemprop="name">Contact Us</span></a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Create <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/products/create') }}">A product</a></li>
                            <li><a href="{{ url('/catalogues/create') }}">A catalogue</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">View <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/enquiries') }}">All Enquiries</a></li>
                            <li><a href="{{ url('/products') }}">All products</a></li>
                            <li><a href="{{ url('/catalogues') }}">All catalogues</a></li>
                        </ul>
                    </li>
                @endif
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if(Auth::user())
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

@unless(isset($stickyNav) && $stickyNav)
    <div class="default-navbar-bg" style="background-image: url('{{ asset('img/jumbotron-img-1.jpg') }}')"></div>
@endunless