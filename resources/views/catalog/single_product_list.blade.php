<div class="single-product" data-id="{{ $item->id }}">
    <div class="pro-img">
        <a href="{{ $item->url }}">
            @if(count($item->images))
                @foreach($item->images as $image)
                    @if ($loop->iteration == 1)
                        <img class="primary-img" src="{{ $image->thumb(2, $item->catalog->alias) }}"
                             alt="{{ $item->name }}">
                    @elseif ($loop->iteration == 2)
                        <img class="secondary-img" src="{{ $image->thumb(2, $item->catalog->alias) }}"
                             alt="{{ $item->name }}">
                    @endif
                @endforeach
            @endif
        </a>
    </div>
    <div class="pro-content">
        <div class="product-rating">
            @if($item->rate === 0)
                <i class="fa fa-star-o"></i>
                <i class="fa fa-star-o"></i>
                <i class="fa fa-star-o"></i>
                <i class="fa fa-star-o"></i>
                <i class="fa fa-star-o"></i>
            @else
                @foreach([1,2,3,4,5] as $n)
                    @if($n <= $item->rate)
                        <i class="fa fa-star"></i>
                    @else
                        <i class="fa fa-star-o"></i>
                    @endif
                @endforeach
            @endif
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
        <p>{{ $item->announce ?: 'Анонс' }} R: {{ $item->rate }}</p>
        @include('catalog.pro_actions')
    </div>
</div>
