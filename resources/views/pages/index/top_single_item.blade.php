<div class="single-product top">
    <div class="pro-img">
        @if($img = $item->images()->first())
            <a href="{{ $item->url }}"><img class="img" src="{{ $img->thumb(1, $item->catalog->alias) }}" alt="{{ $item->name }}"></a>
        @else
            <a href="{{ $item->url }}"><img class="img" src="{{ \Adminlte3\Models\ProductImage::NO_IMAGE }}" alt="{{ $item->name }}"></a>
        @endif
    </div>
    <div class="pro-content">
        <div class="product-rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
        </div>
        <h4><a href="{{ $item->url }}">{{ $item->name }}</a></h4>
        <p>
            @if($item->price)
                <span class="price">{{ number_format($item->price, 0, '.', ' ') }} ₽</span>
            @else
                <span class="price">Под заказ</span>
            @endif

            @if($item->old_price)
                <del class="prev-price">{{ number_format($item->old_price, 0, '.', ' ') }} ₽</del>
            @endif
        </p>
    </div>
</div>
