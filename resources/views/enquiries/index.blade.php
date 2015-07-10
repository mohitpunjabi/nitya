@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <br/>
                <h1 class="page-header">All Enquiries</h1>

                    @if($enquiries->isEmpty())
                        <p>There are no enquiries yet.</p>
                    @endif
                    @foreach($enquiries as $enquiry)
                        <div class="row">
                            <div class="col-xs-3 col-sm-2">
                                @if(isset($enquiry->product))
                                    @include('products.partials.thumbnail', [
                                        'product' => $enquiry->product,
                                        'small'   => true
                                    ])
                                @endif
                            </div>
                            <div class="col-xs-9  col-sm-10">
                                <p class="lead">{!! nl2br(htmlentities($enquiry->message)) !!}</p>
                                <p class="small text-muted">{{ $enquiry->created_at->diffForHumans() }}</p>

                                <p class="small">
                                    <strong>{{ $enquiry->name }}</strong><br/>
                                    {{ $enquiry->email }}<br/>
                                    {{ $enquiry->contact }}<br/>
                                </p>
                            </div>
                        </div>
                        <hr/>
                    @endforeach
                <br/>

                <div class="text-center">
                    {!! $enquiries->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection