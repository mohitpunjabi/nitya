@extends('app', [
    'title' => 'Kurtis, Palazzos, Gota Patti, Dress Material and more'
])

@section('content')
    <div class="jumbotron jumbotron-sm" >
        <div class="container">
            <h1 class="text-center">Our products</h1>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <p class="text-center lead">We work hard towards differentiating our products from the market and providing our customers some fresh prints and designs every week. </p>
                    <p class="text-center">If you need more details about any of them, please send an enquiry.</p>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row product-grid">
            @foreach($products as $product)
                <div class="col-sm-6 col-md-3">
                    @include('products.partials.thumbnail', ['product' => $product])
                </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-md-6 col-md-offset-3 col-sm-12">
                <a data-loading-text="<h2>Loading More ...</h2>" href="{{ ($products->nextPageUrl())? $products->nextPageUrl(): url('more') }}" class="btn btn-block btn-lg btn-primary btn-load-more">
                    <h2><i class="glyphicon glyphicon-plus"></i> More</h2>
                </a>
            </div>
        </div>
        <br/><br/>

    </div>
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
              "@id": "{{ url('products') }}",
              "name": "Products"
            }
          }
          @if($products->currentPage() > 1)
          ,{
            "@type": "ListItem",
            "position": 3,
            "item": {
              "@id": "{{ Request::url() }}",
              "name": "Page {{ $products->currentPage() }}"
            }
          }
          @endif
          ]
        }
    </script>
@endsection