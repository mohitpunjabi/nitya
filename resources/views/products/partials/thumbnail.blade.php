<div class="thumbnail thumbnail-product @if(!$product->available) transparent @endif">
    <div class="img-container">
        @if(isset($product->images[0]))
            <img class="img img-responsive" src="{{ asset('img/md/' . $product->images[0]->name) }}" alt="{{ $product->name }}">
        @endif
        <a href="{{ url('products/' . $product->id) }}" class="detail-link">
            <span>View details</span>
        </a>
    </div>
    <div class="caption">
        @unless(isset($small))
            @if(Auth::user())
                <div>
                    @foreach($product->catalogues as $catalogue)
                        @include('catalogues.partials.tag', [
                            'catalogue' => $catalogue,
                            'product'   => $product
                        ])
                    @endforeach
                </div>
            @endif
            <h3>
                @if(!$product->available)
                    <span class="label label-warning">Unavailable</span>
                @endif
                {{ $product->name }}
            </h3>
            <p>{{ $product->description }}</p>
        @endunless
        <div class="clearfix">
            <div class="pull-left">
                <small class="text-primary">ID {{ $product->design_no }}</small>
            </div>
            @unless(isset($small))
                <div class="pull-right">
                    @if(Auth::guest())
                        <a href="{{ url('products/' . $product->id . '#enquire') }}" class="btn btn-xs btn-primary" role="button">Enquire</a>
                    @else
                        @if(isset($currentCatalogue))
                            <a href="{{ url('catalogues/' . $currentCatalogue->id . '/remove?product=' . $product->id) }}" class="btn btn-xs btn-danger" title="Remove this product from {{ $currentCatalogue->name }}">&times; Remove</a>
                        @endif
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-xs btn-primary" role="button">Edit</a>
                    @endif
                </div>
            @endunless
        </div>
    </div>
</div>