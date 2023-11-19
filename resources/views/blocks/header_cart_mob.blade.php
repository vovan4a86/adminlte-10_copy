<a class="link-basket" href="{{ route('cart') }}">
    <span class="link-basket__icon iconify" data-icon="ps:cart"></span>
    <span class="link-basket__label">{{ \Fanky\Admin\Cart::count() }}</span>
</a>
