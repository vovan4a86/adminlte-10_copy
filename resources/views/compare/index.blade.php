@extends('template')
@section('content')
    @include('blocks.bread')

    <div class="compare-product pb-40">
        <div class="container">
            @if(count($items))
                <div class="table-responsive">
                    <table class="table text-center compare-content">
                        <tbody>
                        <tr>
                            <td class="product-title">Товар</td>
                            @foreach($items as $item)
                                <td class="product_{{ $item->id }} product-description">
                                    <div class="compare-details">
                                        <div class="compare-detail-img">
                                            @if($img = $item->images()->first())
                                                <a href="{{ $item->url }}"><img
                                                        src="{{ $img->thumb(2, $item->catalog->alias) }}"
                                                        alt="{{ $item->name }}"></a>
                                            @else
                                                <a href="{{ $item->url }}"><img
                                                        src="{{ \Adminlte3\Models\ProductImage::NO_IMAGE }}"
                                                        alt="{{ $item->name }}"></a>
                                            @endif
                                        </div>
                                        <div class="compare-detail-content">
                                            <span>Каталог: <a
                                                    href="{{ $item->catalog->url }}">{{ $item->catalog->name }}</a></span>
                                            <h4><a href="{{ $item->url }}">{{ $item->name }}</a></h4>
                                        </div>
                                    </div>
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="product-title">Анонс</td>
                            @foreach($items as $item)
                                <td class="product_{{ $item->id }} product-description">{{ $item->announce ?: 'нет' }}</td>
                            @endforeach
                        </tr>
                        @foreach($compare_names as $compare_name)
                            <tr>
                                <td class="product-title">{{ $compare_name->name }}</td>
                                @foreach($items as $item)
                                    <td class="product_{{ $item->id }} product-description">{{ $item->getCharByName($compare_name->name) ?: '-' }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                        <tr>
                            <td class="product-title">Цена</td>
                            @foreach($items as $item)
                                @if($item->price)
                                    <td class="product_{{ $item->id }} product-description">{{ number_format($item->price, 0, '.', ' ') }} ₽</td>
                                @else
                                    <td class="product_{{ $item->id }} product-description">Под заказ</td>
                                @endif
                            @endforeach
                        </tr>
                        <tr>
                            <td class="product-title">Наличие</td>
                            @foreach($items as $item)
                                <td class="product_{{ $item->id }} product-description">{{ $item->in_stock }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="product-title">В корзину</td>
                            @foreach($items as $item)
                                <td class="product_{{ $item->id }} product-description">
                                    @if(Cart::ifInCart($item->id))
                                        <a class="compare-cart text-uppercase added"
                                           data-id="{{ $item->id }}"
                                           href="{{ route('ajax.cart.add') }}">В корзине</a>
                                    @else
                                        <a class="compare-cart text-uppercase"
                                           data-id="{{ $item->id }}"
                                           href="{{ route('ajax.cart.add') }}">В корзину</a>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="product-title">Удалить</td>
                            @foreach($items as $item)
                                <td class="product_{{ $item->id }} product-description delete">
                                    <i class="fa fa-trash-o"
                                       data-id="{{ $item->id }}"
                                       data-url="{{ route('ajax.compare-delete') }}"
                                    ></i>
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="product-title">Рейтинг</td>
                            @foreach($items as $item)
                                <td class="product_{{ $item->id }} product-description">
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
                                </td>
                            @endforeach
                        </tr>
                        </tbody>
                    </table>
                </div>
            @else
                <h4>Пусто</h4>
            @endif
        </div>
    </div>

    @include('blocks.brands')
@endsection
