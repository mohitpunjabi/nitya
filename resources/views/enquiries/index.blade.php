@extends('app', [
    'noIndex' => true
])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <br/>
                <h1 class="page-header">
                    All Enquiries

                    @if(isset($showingRead) && $showingRead)
                        <a class="btn btn-default pull-right" href="{{ url('enquiries') }}">Hide read enquiries</a>
                    @else
                        <a class="btn btn-default pull-right" href="{{ url('enquiries/read') }}">Show read enquiries</a>
                    @endif
                </h1>

                <div class="alert alert-success">
                    <strong>NEW!</strong>
                    Enquiries are now also sent to gmail directly. Check for mails labeled <span class="label label-default">enquired</span> on gmail.
                </div>



            @if($enquiries->isEmpty())
                        <p>There are no enquiries yet.</p>
                    @endif
                    @foreach($enquiries as $enquiry)
                        @unless($enquiry->trashed()) <div class="well well-sm">@endunless
                        <div class="row enquiry">
                            <div class="col-xs-3 col-sm-2">
                                @if(isset($enquiry->product))
                                    @include('products.partials.thumbnail', [
                                        'product' => $enquiry->product,
                                        'small'   => true
                                    ])
                                @endif
                            </div>
                            <div class="col-xs-9 col-sm-10">

                                {!! Form::open(['method' => 'DELETE', 'route' => ['enquiries.destroy', $enquiry], 'class' => 'pull-right']) !!}
                                    @if($enquiry->trashed())
                                        <button class="btn btn-info btn-xs" type="submit" title="Mark unread"><i class="glyphicon glyphicon-unchecked"></i> Mark as unread</button>
                                    @else
                                        <button class="btn btn-warning btn-xs" type="submit" title="Mark read"><i class="glyphicon glyphicon-check"></i> Mark as read</button>
                                    @endif
                                {!! Form::close() !!}

                                <a target="_blank" class="btn btn-primary btn-xs pull-right btn-reply" href="mailto:{{ $enquiry->email }}"><i class="glyphicon glyphicon-share-alt"></i> Reply</a>

                                <p class="lead">{!! nl2br(htmlentities($enquiry->message)) !!}</p>
                                <p class="small text-muted">{{ $enquiry->created_at->diffForHumans() }}</p>

                                <p class="small">
                                    <strong>{{ $enquiry->name }}</strong><br/>
                                    {{ $enquiry->email }}<br/>
                                    {{ $enquiry->contact }}
                                </p>
                            </div>
                        </div>
                        @unless($enquiry->trashed()) </div>@endunless
                    @endforeach
                <br/>

                <div class="text-center">
                    {!! $enquiries->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection