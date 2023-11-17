<section class="s-specials" x-data="{ currentView: 'Газоснабжение' }">
    <div class="s-specials__container container">
        <div class="s-specials__title">Акции и спецпредложения</div>
        <!-- ._tabs-->
        <div class="s-specials__tabs">
            @foreach($mainSections as $section)
                <div class="s-specials__tab" @click="currentView = '{{ $section->name }}'"
                     :class="currentView == '{{ $section->name }}' &amp;&amp; 'is-active'">{{ $section->name }}
                </div>
            @endforeach
        </div>
        <div class="s-specials__views">
            @foreach($mainSections as $section)
            <div class="s-specials__view swiper" x-show="currentView == '{{ $section->name }}'" data-gas-slider
                 x-cloak>
                <div class="s-specials__wrapper swiper-wrapper">
                    @foreach($section->getMainSectionProductActions() as $item)
                        <div class="s-specials__slide swiper-slide">
                            @include('catalog.product_card_more')
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="slider-nav" x-show="currentView == '{{ $section->name }}'" x-cloak>
                <div class="slider-nav__btn slider-nav__btn--prev" data-gas-slider-prev>
                    <svg class="svg-sprite-icon icon-arrow-left">
                        <use xlink:href="/static/images/sprite/symbol/sprite.svg#arrow-left"></use>
                    </svg>
                </div>
                <div class="slider-nav__btn slider-nav__btn--next" data-gas-slider-next>
                    <svg class="svg-sprite-icon icon-arrow-right">
                        <use xlink:href="/static/images/sprite/symbol/sprite.svg#arrow-right"></use>
                    </svg>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
