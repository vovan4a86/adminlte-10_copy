@if($videoSlider)
    <div class="hero__container container">
        <div class="hero__slider swiper" data-hero-slider>
            <div class="hero__wrapper swiper-wrapper">
                @foreach($videoSlider as $group)
                    @foreach($group as $slide)
                        @if(array_get($slide, 'main_video_slider_link'))
                            <div class="hero__slide {{ $videoSliderStyles[$loop->index] }} swiper-slide">
                                <a class="hero__video"
                                   href="https://www.youtube.com/watch?v={{ array_get($slide, 'main_video_slider_link') }}"
                                   data-fancybox="video-gallery">
                                    <picture>
                                        <img class="hero__pic lazy" src="/"
                                             data-src="{{ Settings::fileSrc(array_get($slide, 'main_video_slider_img')) }}"
                                             width="{{ $videoSliderWidths[$loop->index] }}" height="270" alt="">
                                    </picture>
                                </a>
                            </div>
                        @else
                            <div class="hero__slide hero__slide--image {{ $videoSliderStyles[$loop->index] }} swiper-slide">
                                <a class="hero__video"
                                   href="{{ Settings::fileSrc(array_get($slide, 'main_video_slider_img')) }}"
                                   data-fancybox="video-gallery">
                                    <picture>
                                        <img class="hero__pic lazy" src="/"
                                             data-src="{{ Settings::fileSrc(array_get($slide, 'main_video_slider_img')) }}"
                                             width="{{ $videoSliderWidths[$loop->index] }}" height="270" alt="">
                                    </picture>
                                </a>
                            </div>
                        @endif
                    @endforeach
                @endforeach
            </div>
        </div>
        <div class="slider-nav">
            <div class="slider-nav__btn slider-nav__btn--prev" data-hero-slider-prev>
                <svg class="svg-sprite-icon icon-arrow-left">
                    <use xlink:href="/static/images/sprite/symbol/sprite.svg#arrow-left"></use>
                </svg>
            </div>
            <div class="slider-nav__btn slider-nav__btn--next" data-hero-slider-next>
                <svg class="svg-sprite-icon icon-arrow-right">
                    <use xlink:href="/static/images/sprite/symbol/sprite.svg#arrow-right"></use>
                </svg>
            </div>
        </div>
    </div>
@endif
