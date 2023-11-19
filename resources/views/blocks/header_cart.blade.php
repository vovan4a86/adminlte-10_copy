<li class="h-menu__item">
    <a class="h-menu__link link-basket" href="{{ route('cart') }}">
        <span class="link-basket__icon iconify" data-icon="ps:cart"></span>
        <span class="link-basket__label">{{ Cart::count() }}</span>
    </a>
</li>
