@if(isset($enquiry['product']))
    <p>
        <strong>Product: </strong>
        <a href="{{ url_product($enquiry['product']) }}" title="{{ $enquiry['product']['name'] }}">
            {{ $enquiry['product']['design_no'] }} - {{ $enquiry['product']['name'] }}
        </a>
    </p>
@endif

<p>{!! nl2br(htmlentities($enquiry['message'])) !!}</p>

--

<p>
    <strong>{{ $enquiry['name'] }}</strong><br/>
    {{ $enquiry['email'] }}<br/>
    {{ $enquiry['contact'] }}
</p>