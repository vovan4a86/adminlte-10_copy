@extends('template')
@section('content')
    @include('blocks.bread')
    <div class="cart-main-area pb-80 pb-sm-50">
        <div class="container">
            <h2 class="text-capitalize sub-heading">Корзина</h2>
            @if(count($items))
            <div class="row">
                <div class="col-md-12">
                    <form action="#">
                        <div class="table-content table-responsive mb-50">
                            <table>
                                <thead>
                                <tr>
                                    <th class="product-thumbnail">Изображение</th>
                                    <th class="product-name">Товар</th>
                                    <th class="product-price">Цена</th>
                                    <th class="product-quantity">Количество</th>
                                    <th class="product-subtotal">Итого</th>
                                    <th class="product-remove">Удалить</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $item)
                                        @include('cart.cart_item')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 col-md-7">
                                <div class="buttons-cart">
                                    <a href="{{ route('catalog.index') }}">Продолжить покупки</a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="cart_totals">
                                    <h2>Общий итог</h2>
                                    <br />
                                    <table>
                                        <tbody>
                                        <tr class="cart-subtotal">
                                            <th>Без скидки</th>
                                            <td><span class="amount">{{ number_format(Cart::sum(), 0, '.' , ' ') }} ₽</span></td>
                                        </tr>
                                        <tr class="order-total">
                                            <th>Всего</th>
                                            <td>
                                                <strong><span class="amount">{{ number_format(Cart::sum(), 0, '.' , ' ') }} ₽</span></strong>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="wc-proceed-to-checkout">
                                        <a href="{{ route('cart.checkout') }}">Оформить заказ</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @else
                <div class="row">
                    <div class="col-md-12">
                        <h4>Пока ничего не добавлено...</h4>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="brand-area pb-60">
        <div class="container">
            <!-- Brand Banner Start -->
            <div class="brand-banner owl-carousel">
                <div class="single-brand">
                    <a href="#"><img class="img" src="img/brand/1.png" alt="brand-image"></a>
                </div>
                <div class="single-brand">
                    <a href="#"><img src="img/brand/2.png" alt="brand-image"></a>
                </div>
                <div class="single-brand">
                    <a href="#"><img src="img/brand/3.png" alt="brand-image"></a>
                </div>
                <div class="single-brand">
                    <a href="#"><img src="img/brand/4.png" alt="brand-image"></a>
                </div>
                <div class="single-brand">
                    <a href="#"><img src="img/brand/5.png" alt="brand-image"></a>
                </div>
                <div class="single-brand">
                    <a href="#"><img class="img" src="img/brand/1.png" alt="brand-image"></a>
                </div>
                <div class="single-brand">
                    <a href="#"><img src="img/brand/2.png" alt="brand-image"></a>
                </div>
                <div class="single-brand">
                    <a href="#"><img src="img/brand/3.png" alt="brand-image"></a>
                </div>
                <div class="single-brand">
                    <a href="#"><img src="img/brand/4.png" alt="brand-image"></a>
                </div>
                <div class="single-brand">
                    <a href="#"><img src="img/brand/5.png" alt="brand-image"></a>
                </div>
            </div>
            <!-- Brand Banner End -->
        </div>
    </div>
@endsection
