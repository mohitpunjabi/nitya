@extends('app', [
    'title'           => $product->name,
    'metaDescription' => $product->description,
    'ogImage'         => asset('img/md/'.$product->images[0]->name)
])

@section('content')
    <div itemscope itemtype="http://schema.org/Product">
    <meta itemprop="url" content="{{ url_product($product) }}"/>
        @if($product->previous)
            <a href="{{ url_product($product->previous) }}">
                <div class="paginate-col pull-left hidden-sm hidden-xs">
                    <div class="paginate-button">
                        <i class="glyphicon glyphicon-circle-arrow-left"></i>
                    </div>
                </div>
            </a>
        @endif
        @if($product->next)
            <a href="{{ url_product($product->next) }}">
                <div class="paginate-col pull-right hidden-sm hidden-xs">
                    <div class="paginate-button">
                        <i class="glyphicon glyphicon-circle-arrow-right"></i>
                    </div>
                </div>
            </a>
        @else
            <a href="{{ url('more') }}">
                <div class="paginate-col pull-right hidden-sm hidden-xs">
                    <div class="paginate-button">
                        <i class="glyphicon glyphicon-circle-arrow-right"></i>
                    </div>
                </div>
            </a>
        @endif

    <div class="jumbotron jumbotron-sm">
        <meta itemprop="productID" content="{{ $product->design_no }}"/>
        <div class="row">
            <div class="col-md-5 col-md-offset-1 col-lg-4 col-lg-offset-2">
                <div class="magnify thumbnail">
                    <img class="img img-responsive center-block display-image">
                    <a href="#" class="show-on-hover btn-zoom"><i class="glyphicon glyphicon-zoom-in"></i> Full screen</a>

                    <ul class="row thumbnails show-on-hover text-right">
                        @foreach($product->images as $image)
                            <meta itemprop="image" content="{{ asset('img/lg/' . $image->name) }}"/>
                            <li class="thumbnail col-xs-1" data-large-src="{{ asset('img/lg/'.$image->name) }}" data-small-src="{{ asset('img/md/'.$image->name) }}" data-thumbnail-src="{{ asset('img/sm/'.$image->name) }}">
                                <a href="#">
                                    <img itemprop="image" class="img img-responsive" src="{{ asset('img/lg/'.$image->name) }}" >
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
            <div class="col-md-5 col-lg-4">
                <div id="zoomView">
                </div>

                <ol class="breadcrumb" style="background: transparent; border: 0" itemscope itemtype="http://schema.org/BreadcrumbList">
                    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                        <a itemprop="item"  href="{{ url() }}"><span itemprop="name">Home</span></a>
                        <meta itemprop="position" content="1" />
                    </li>
                    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                        <a itemprop="item"  href="{{ url('products') }}"><span itemprop="name">Products</span></a>
                        <meta itemprop="position" content="2" />
                    </li>
                    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                        <a itemprop="item" class="active" href="{{ url_product($product) }}"><span itemprop="name">{{ $product->name }}</span></a>
                        <meta itemprop="position" content="3" />
                    </li>
                </ol>

                <div class="product-details">
                    @if(Auth::user())
                        <div>
                            @foreach($product->catalogues as $catalogue)
                                @include('catalogues.partials.tag', [
                                    'size' => 'lg',
                                    'product' => $product,
                                    'catalogue' => $catalogue
                                ])
                            @endforeach
                        </div>
                        <br/>
                    @endif
                    <h2 class="media-heading" itemprop="name">@if(!$product->available)<span class="text-lg label label-warning">Unavailable</span> @endif{{ $product->name }}</h2>
                    <p class="lead" itemprop="description">{{ $product->description }}</p>
                    <table class="table">
                        <tr itemprop="additionalProperty" itemscope itemtype="http://schema.org/PropertyValue">
                            <th itemprop="name">Design Number</th>
                            <td itemprop="value">{{ $product->design_no }}</td>
                        </tr>

                        @if($product->sizes)
                            <tr itemprop="additionalProperty" itemscope itemtype="http://schema.org/PropertyValue">
                                <th itemprop="name">Available Sizes</th>
                                <td itemprop="value">{{ $product->sizes }}</td>
                            </tr>
                        @endif

                        @if($product->length)
                            <tr itemprop="additionalProperty" itemscope itemtype="http://schema.org/PropertyValue">
                                <th itemprop="name">Length</th>
                                <td itemprop="value">{{ $product->length }}</td>
                            </tr>
                        @endif

                        @if($product->neckline)
                            <tr itemprop="additionalProperty" itemscope itemtype="http://schema.org/PropertyValue">
                                <th itemprop="name">Neckline</th>
                                <td itemprop="value">{{ $product->neckline }}</td>
                            </tr>
                        @endif

                        @if($product->fabric)
                            <tr itemprop="additionalProperty" itemscope itemtype="http://schema.org/PropertyValue">
                                <th itemprop="name">Fabric</th>
                                <td itemprop="value">{{ $product->fabric }}</td>
                            </tr>
                        @endif

                        @if($product->rinse_care)
                            <tr itemprop="additionalProperty" itemscope itemtype="http://schema.org/PropertyValue">
                                <th itemprop="name">Rinse Care</th>
                                <td itemprop="value">{{ $product->rinse_care }}</td>
                            </tr>
                        @endif

                    </table>

                        @if(Session::has('sent'))
                            <div class="alert alert-success">
                                <h3>Thank you for contacting us</h3>
                                <p>Your enquiry has been sent. We will get back to you as soon as we can.</p>
                            </div>
                        @else
                            <div>
                                @if(Auth::guest())
                                    <p>
                                        <a href="#enquire" id="sendEnquiryBtn" class="btn btn-lg btn-primary btn-block">Send an enquiry</a>
                                    </p>
                                @else
                                    <a href="{{ route('products.edit', $product) }}" class="btn btn-lg btn-primary btn-block" role="button">Edit</a>

                                @endif

                            </div>
                        @endif
                </div>

                <div id="enquire" class="enquiry-form" style="display: none">
                    <h2 class="media-heading">Need more details?</h2>
                    <p>Please fill out your contact details, and we shall get back to you.</p>
                    @include('enquiries.partials.form', [
                        'id' => 'ajaxContactForm',
                        'cancelButton' => true,
                        'product' => $product
                    ])
                </div>
            </div>
        </div>

        <div class="row hidden-md hidden-lg">
            <br/><br/>
            @if($product->previous)
                    <div class="col-xs-6">
                        <a href="{{ url_product($product->previous) }}" class="btn btn-lg btn-block btn-default">
                            <i class="glyphicon glyphicon-chevron-left"></i> Previous
                        </a>
                    </div>
            @endif
            @if($product->next)
                    <div class="col-xs-6">
                        <a href="{{ url_product($product->next) }}" class="btn btn-lg btn-block btn-primary">
                            Next <i class="glyphicon glyphicon-chevron-right"></i>
                        </a>
                    </div>
            @else
                    <div class="col-xs-6">
                        <a href="{{ url('more') }}" class="btn btn-lg btn-block btn-info">
                            Next <i class="glyphicon glyphicon-chevron-right"></i>
                        </a>
                    </div>
            @endif
        </div>

    </div>
    <div class="container">
        <h3 class="page-header">You might also like</h3>
        <div class="row product-grid">
            @foreach($product->similarProducts as $simProduct)
                <div class="col-sm-6 col-md-3">
                    @include('products.partials.thumbnail', [
                        'product' => $simProduct,
                        'isSimilarTo' => true
                    ])
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection