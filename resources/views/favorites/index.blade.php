@extends('template')
@section('content')
    @include('blocks.bread')

    <div class="cart-main-area wish-list pb-60">
        <div class="container">
            <h2 class="text-capitalize sub-heading">Список желаний</h2>
            @if(count($items))
                <div class="row">
                    <div class="col-md-12">
                        <form action="#">
                            <div class="table-content table-responsive">
                                <table>
                                    <thead>
                                    <tr>
                                        <th class="product-remove">Удалить</th>
                                        <th class="product-thumbnail">Изображение</th>
                                        <th class="product-name">Товар</th>
                                        <th class="product-price">Цена за ед.</th>
                                        <th class="product-quantity">Наличие</th>
                                        <th class="product-subtotal">Добавить</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($items as $item)
                                        <tr data-id="{{ $item->id }}">
                                            <td class="product-remove favorite">
                                                <a href="{{ route('ajax.favorite-delete') }}">
                                                    <i class="fa fa-times" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                            <td class="product-thumbnail">
                                                <a href="{{ $item->url }}">
                                                    <img src="{{ $item->getImage() }}" alt="{{ $item->name }}" />
                                                </a>
                                            </td>
                                            <td class="product-name">
                                                <a href="{{ $item->url }}">{{ $item->name }}</a>
                                            </td>
                                            <td class="product-price">
                                                @if($item->price)
                                                    <span class="amount">{{ number_format($item->price, 0, '.', ' ') }} ₽</span>
                                                @else
                                                    <span class="amount">Под заказ</span>
                                                @endif
                                            </td>
                                            <td class="product-stock-status">
                                                <span>{{ $item->in_stock ? 'В наличии' : 'Нет' }}</span>
                                            </td>
                                            <td class="product-add-to-cart">
                                                @if($item->in_stock)
                                                    @if(Cart::ifInCart($item->id))
                                                        <a class="favorites-add-cart added"
                                                           href="{{ route('ajax.cart.add') }}">В корзине</a>
                                                    @else
                                                        <a class="favorites-add-cart"
                                                           href="{{ route('ajax.cart.add') }}">В корзину</a>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-md-12">
                        <h4>Пусто</h4>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @include('blocks.brands')
@endsection
