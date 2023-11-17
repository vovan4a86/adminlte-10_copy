<button class="product__order btn-reset"
        type="button" aria-label="{{ \Fanky\Admin\Cart::ifInCart($id) ?
                                'В листе заказа' : 'Положить в лист заказа' }}"
        data-id="{{ $id }}"
        {{ \Fanky\Admin\Cart::ifInCart($id) ? 'disabled' : '' }}>
        <span>
            {{ \Fanky\Admin\Cart::ifInCart($id) ?
                'В листе заказа' : 'Положить в лист заказа' }}
        </span>
</button>
