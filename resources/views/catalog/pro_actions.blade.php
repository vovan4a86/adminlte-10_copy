<div class="pro-actions">
    <div class="actions-secondary">
        @if(in_array($item->id, session('favorites', [])))
            <a href="{{ route('ajax.favorite') }}"
               class="favorites added"
               data-toggle="tooltip" title="В списке желаний">
                <i class="fa fa-heart"></i>
            </a>
        @else
            <a href="{{ route('ajax.favorite') }}"
               class="favorites"
               data-toggle="tooltip" title="В список желаний">
                <i class="fa fa-heart"></i>
            </a>
        @endif
        @if(Cart::ifInCart($item->id))
            <a class="add-cart add-cart-card added"
               href="{{ route('ajax.cart.add') }}"
               data-toggle="tooltip" title="В корзине">
                В корзине
            </a>
        @else
            <a class="add-cart add-cart-card"
               href="{{ route('ajax.cart.add') }}"
               data-toggle="tooltip" title="В корзину">
                В корзину
            </a>
        @endif
        <a href="compare.html" data-toggle="tooltip" title="Добавить в сравнение"><i class="fa fa-signal"></i></a>
    </div>
</div>
