<div class="thumbnail thumbnail-product">
    <div class="img-container">
        <img class="img img-responsive" src="{{ asset('img/md/' . $product->images[0]->name) }}" alt="{{ $product->name }}">
        <a href="{{ url('products/' . $product->id) }}" class="detail-link">
            <span>View details</span>
        </a>
    </div>
    <div class="caption">
        @unless(isset($small))
            <h3>{{ $product->name }}</h3>
            <p>{{ $product->description }}</p>
        @endunless
        <div class="clearfix">
            <div class="pull-left">
                <small class="text-primary">ID {{ $product->design_no }}</small>
            </div>
            @unless(isset($small))
                <div class="pull-right">
                    <a href="{{ url('products/' . $product->id . '#enquire') }}" class="btn btn-xs btn-primary" role="button">Enquire</a>
                </div>
            @endunless
        </div>
    </div>
</div>