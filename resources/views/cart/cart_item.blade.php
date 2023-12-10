<tr data-id="{{ $item['id'] }}">
    <td class="product-thumbnail">
        <a href="{{ $item['url'] }}">
            <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" />
        </a>
    </td>
    <td class="product-name">
        <a href="{{ $item['url'] }}">{{ $item['name'] }}</a>
    </td>
    <td class="product-price">
        <span class="amount">{{ number_format($item['price'], 0, '.', ' ') }} ₽</span>
    </td>
    <td class="product-quantity">
        <input type="number" value="{{ $item['qnt'] }}" />
    </td>
    <td class="product-subtotal val">
        {{ number_format($item['price'] * $item['qnt'], 0, '.', ' ') }} ₽
    </td>
    <td class="product-remove">
        <a href="{{ route('ajax.cart.remove') }}" class="cart-item-remove">
            <i class="fa fa-times" aria-hidden="true"></i>
        </a>
    </td>
</tr>
