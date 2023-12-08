<div class="single-product">
    <div class="pro-img">
        <a href="{{ $item->url }}">
            @if(count($item->images))
                @foreach($item->images as $image)
                    @if ($loop->iteration == 1)
                        <img class="primary-img" src="{{ $image->thumb(2, $item->catalog->alias) }}" alt="{{ $item->name }}">
                    @elseif ($loop->iteration == 2)
                        <img class="secondary-img" src="{{ $image->thumb(2, $item->catalog->alias) }}" alt="{{ $item->name }}">
                    @endif
                @endforeach
            @endif
        </a>
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
        <div class="pro-actions">
            <div class="actions-secondary">
                <a href="wishlist.html" data-toggle="tooltip" title="В список желаний"><i class="fa fa-heart"></i></a>
                <a class="add-cart" href="cart.html" data-toggle="tooltip" title="В корзину">В корзину</a>
                <a href="compare.html" data-toggle="tooltip" title="Добавить в сравнение"><i class="fa fa-signal"></i></a>
            </div>
        </div>
    </div>
</div>
