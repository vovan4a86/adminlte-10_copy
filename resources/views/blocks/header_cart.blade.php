<li class="header-cart">
    <a href="{{ route('cart') }}"><i class="fa fa-shopping-basket"></i>
        <span class="cart-counter">{{ Cart::count() }}</span>
    </a>
    @if(isset($cart_items) && count($cart_items) > 0)
        <ul class="ht-dropdown main-cart-box">
            <li>
                @foreach($cart_items as $item)
                    <div class="single-cart-box" data-id="{{ $item['id'] }}">
                        <div class="cart-img">
                            <a href="{{ $item['url'] }}">
                                <img src="{{ $item['image']  }}" alt="{{ $item['name'] }}">
                            </a>
                        </div>
                        <div class="cart-content">
                            <h6><a href="{{ $item['url'] }}">{{ $item['name'] }}</a></h6>
                            <span>{{ $item['qnt'] }} × {{ number_format($item['price'], 0, '.', ' ') }} ₽</span>
                        </div>
                        <a class="del-icone" href="{{ route('ajax.cart.remove') }}"><i class="fa fa-window-close-o"></i></a>
                    </div>
                @endforeach
                <div class="cart-footer fix">
                    <h5>Итог: <span class="f-right">{{ number_format(Cart::sum(), 0, '.', ' ') }} ₽</span></h5>
                    <div class="cart-actions">
                        <a class="checkout" href="{{ route('cart') }}">Оформить</a>
                    </div>
                </div>
            </li>
        </ul>
    @endif
</li>
