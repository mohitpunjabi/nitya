<div class="thumbnail thumbnail-product @if(!$product->available) transparent @endif"
     @if(isset($isSimilarTo) && $isSimilarTo) itemprop="isSimilarTo" @endif
     itemscope itemtype="http://schema.org/Product">
    <div class="img-container">
        @if(isset($product->images[0]))
            <img itemprop="image" class="img img-responsive center-block" data-attribute="image" src="{{ $product->images[0]->path('md') }}" alt="{{ $product->name }}">
        @endif
        <a href="{{ url_product($product) }}"itemprop="url" data-attribute="name" class="detail-link" title="{{ $product->name }}">
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
                <span itemprop="name" data-attribute="image">{{ $product->name }}</span>
            </h3>
            <p itemprop="description" data-attribute="description">{{ $product->description }}</p>
        @endunless
        <div class="clearfix">
            <div class="pull-left">
                <small class="text-primary" data-attribute="design_no">ID <span itemprop="productID">{{ $product->design_no }}</span></small>
            </div>
            @unless(isset($small))
                <div class="pull-right">
                    @if(Auth::guest())
                        <a  data-attribute="enquire_link" href="{{ url('products/' . $product->id . '#enquire') }}" class="btn btn-xs btn-primary" role="button">Enquire</a>
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