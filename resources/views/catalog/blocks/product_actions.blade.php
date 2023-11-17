@if(count($actions))
    <div class="s-specials s-specials--content">
        <div class="s-specials__title">Акции и спецпредложения</div>
        <div class="s-specials__views">
            <div class="s-specials__view swiper" data-specials-slider>
                <div class="s-specials__wrapper swiper-wrapper">
                    @foreach($actions as $item)
                    <div class="s-specials__slide swiper-slide">
                        @include('catalog.product_card_more', ['item' => $item])
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="slider-nav">
                <div class="slider-nav__btn slider-nav__btn--prev" data-specials-slider-prev>
                    <svg class="svg-sprite-icon icon-arrow-left">
                        <use xlink:href="/static/images/sprite/symbol/sprite.svg#arrow-left"></use>
                    </svg>
                </div>
                <div class="slider-nav__btn slider-nav__btn--next" data-specials-slider-next>
                    <svg class="svg-sprite-icon icon-arrow-right">
                        <use xlink:href="/static/images/sprite/symbol/sprite.svg#arrow-right"></use>
                    </svg>
                </div>
            </div>
        </div>
    </div>
@endif
