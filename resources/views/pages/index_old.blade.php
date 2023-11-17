@extends('template')
@section('content')
    <main>
        <section class="hero">
            <div class="hero__container container container--wide">
                <div class="hero__ways">
                    @foreach($mainSections as $section)
                        <div class="hero__way {{ $mainSectionsStyles[$section->id] }}"
                             style="background-image: url({{ $section->urlImage }})"
                             x-data="{ overlayGas: false }">
                            <div class="hero__title">{{ $section->name }}</div>
                            <div class="hero__text">{{ $section->main_desc }}</div>
                            <div class="hero__btn" @mouseover="overlayGas = true">
                                <svg class="svg-sprite-icon icon-plus">
                                    <use xlink:href="/static/images/sprite/symbol/sprite.svg#plus"></use>
                                </svg>
                            </div>
                            <div class="hero__overlay" @mouseleave="overlayGas = false"
                                 :class="overlayGas &amp;&amp; 'is-active'" x-cloak>
                                <div class="hero__subtitle">{{ $section->name }}</div>
                                <ul class="hero__list list-reset">
                                    @foreach($section->children as $gasItem)
                                        <li class="hero__item">
                                            <a class="hero__link" href="{{ $gasItem->url }}">{{ $gasItem->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @include('pages.index.video_slider')
        </section>
        @include('pages.index.popular')
        @include('pages.index.actions')
        <section class="s-form">
            <div class="s-form__wrapper container">
                <div class="s-form__form">
                    @include('blocks.send_request')
                </div>
            </div>
        </section>
        <section class="s-about lazy" data-bg="/static/images/common/s-about-bg.png">
            <div class="s-about__container container">
                <div class="s-about__body">
                    <div class="s-about__content">
                        <div class="s-about__title">О компании</div>
                        <div class="s-about__subtitle">{{ Settings::get('main_about')['main_about_title'] }}</div>
                        <div class="s-about__text">{!! Settings::get('main_about')['main_about_text']  !!}</div>
                        <div class="s-about__row">
                            @foreach(Settings::get('main_about_nums') as $item)
                                <div class="s-about__col">
                                    <div class="s-about__count">{{ array_get($item, 'main_about_nums_title') }}</div>
                                    <div class="s-about__value">{{ array_get($item, 'main_about_nums_text') }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <img class="s-about__pic lazy" src=""
                         data-src="{{ Settings::fileSrc(Settings::get('main_about_img')) }}"
                         width="571" height="612" alt="">
                </div>
            </div>
        </section>
        <section class="s-delivery">
            <div class="s-delivery__wrapper container container--wide">
                <div class="s-delivery__grid">
                    <div class="s-delivery__main">
                        <div class="s-delivery__head">
                            <div class="s-delivery__title">География доставки</div>
                            <div class="s-delivery__subtitle">Осуществляем своевременную доставку по всей России</div>
                            <div class="s-delivery__action">
                                <a class="s-delivery__link" href="{{ route('contacts') }}" title="Смотреть контакты">
                                    <span>Смотреть контакты</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="31" height="12" fill="none">
                                        <path fill="currentColor" d="M30.495 6.495a.7.7 0 0 0 0-.99L26.04 1.05a.7.7 0 1 0-.99.99L29.01 6l-3.96 3.96a.7.7 0 1 0 .99.99l4.455-4.455ZM0 6.7h30V5.3H0v1.4Z"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <img class="s-delivery__decor lazy" src="/static/images/common/delivery-decor-1.png"
                             data-src="/static/images/common/delivery-decor-1.png" width="488" height="518" alt="">
                    </div>
                    <div class="s-delivery__body">
                        <div class="s-delivery__content">
                            <div class="s-delivery__cities">
                                @foreach(Settings::get('main_delivery') as $city)
                                <div class="s-delivery__city">
                                    <svg class="svg-sprite-icon icon-marker" width="1em" height="1em">
                                        <use xlink:href="/static/images/sprite/symbol/sprite.svg#marker"></use>
                                    </svg>
                                    <span>{{ $city }}</span>
                                </div>
                                @endforeach
                            </div>
                            <img class="s-delivery__map lazy" src="/static/images/common/delivery-map.svg"
                                 data-src="/static/images/common/delivery-map.svg" width="704" height="417" alt="">
                        </div>
                        <img class="s-delivery__decor s-delivery__decor--alt lazy" src="/static/images/common/delivery-decor-2.png"
                             data-src="/static/images/common/delivery-decor-2.png" width="556" height="492" alt="">
                    </div>
                </div>
            </div>
        </section>
    </main>
@stop
