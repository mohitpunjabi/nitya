@if(isset($product))
    <p>
        <strong>Product: </strong>
        <a href="{{ url('products/' . $product['id']) }}" title="{{ $product['name'] }}">
            {{ $product['design_no'] }} - {{ $product['name'] }}
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