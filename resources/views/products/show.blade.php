@extends('app')

@section('content')
    <div class="paginate-col pull-left hidden-sm hidden-xs">
        <div class="paginate-button">
            <i class="glyphicon glyphicon-circle-arrow-left"></i>
        </div>
    </div>

    <div class="paginate-col pull-right hidden-sm hidden-xs">
        <div class="paginate-button">
            <i class="glyphicon glyphicon-circle-arrow-right"></i>
        </div>
    </div>

    <div class="jumbotron jumbotron-sm">
        <div class="row">
            <div class="col-md-5 col-md-offset-1 col-lg-4 col-lg-offset-2">
                <div class="magnify thumbnail">
                    <img class="img img-responsive center-block display-image">
                    <a href="#" class="show-on-hover btn-zoom"><i class="glyphicon glyphicon-zoom-in"></i> Full screen</a>

                    <ul class="row thumbnails show-on-hover text-right">
                        @foreach($product->images as $image)
                            <li class="thumbnail col-xs-1" data-large-src="{{ asset('img/lg/'.$image->name) }}" data-small-src="{{ asset('img/md/'.$image->name) }}" data-thumbnail-src="{{ asset('img/sm/'.$image->name) }}">
                                <a href="#">
                                    <img class="img img-responsive" src="{{ asset('img/lg/'.$image->name) }}" >
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
            <div class="col-md-5 col-lg-4">
                <div id="zoomView">
                </div>
                <div class="product-details">
                    <h2 class="media-heading">{{ $product->name }}</h2>
                    <p class="lead">{{ $product->description }}</p>
                    <table class="table">
                        <tr>
                            <th>Design Number</th>
                            <td>{{ $product->design_no }}</td>
                        </tr>

                        <tr>
                            <th>Available Sizes</th>
                            <td><abbr title="38&quot;">M</abbr>, <abbr title="40&quot;">L</abbr>, <abbr title="42&quot;">XL</abbr>, <abbr title="44&quot;">XXL</abbr></td>
                        </tr>
                    </table>

                        @if(Session::has('sent'))
                            <div class="alert alert-success">
                                <h3>Thank you for contacting us</h3>
                                <p>Your enquiry has been sent. We will get back to you as soon as we can.</p>
                            </div>
                        @else
                            <p>
                                <a href="#enquire" id="sendEnquiryBtn" class="btn btn-lg btn-primary btn-block">Send an enquiry</a>
                            </p>
                        @endif
                </div>

                <div id="enquire" class="enquiry-form">
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

    </div>
    <div class="container">
        <h3 class="page-header">You might also like</h3>
        <div class="row product-grid">
            @for($i = 0; $i < 4; $i++)
                <div class="col-sm-6 col-md-3">
                    <div class="thumbnail thumbnail-product">
                        <div class="img-container">
                            <img class="img img-responsive" src="{{ asset('img/try'.($i%6).'.jpg') }}" alt="Alternate text">
                            <a href="{{ url('products/show') }}" class="detail-link">
                                <span>View details</span>
                            </a>
                        </div>
                        <div class="caption">
                            <h3>Lorem ipsum dolor</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            <div class="clearfix">
                                <div class="pull-left">
                                    <small class="text-primary">ID 904035</small>
                                </div>
                                <div class="pull-right">
                                    <a href="#" class="btn btn-xs btn-primary" role="button">Enquire</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>


    <script type="text/javascript">

    </script>

@endsection