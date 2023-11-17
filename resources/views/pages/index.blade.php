@extends('template')
@section('content')
<main>
    <section class="hero">
        <!-- .container--wide-->
        <div class="hero__container container container--wide">
            <div class="hero__ways">
                <!-- ._way-->
                <div class="hero__way hero__way--gas lazy" data-bg="/static/images/common/hero-bg-1.webp" x-data="{ overlayGas: false }">
                    <div class="hero__title">Газоснабжение</div>
                    <div class="hero__text">Большой ассортимент для газоснабжения: от фитингов и муфт до полиэтиленовой трубы и ГРПШ. Большой выбор счетчиков, сигнализаторов, фильтров.</div>
                    <div class="hero__btn" @mouseover="overlayGas = true">
                        <svg class="svg-sprite-icon icon-plus" width="1em" height="1em">
                            <use xlink:href="/static/images/sprite/symbol/sprite.svg#plus"></use>
                        </svg>
                    </div>
                    <div class="hero__overlay" @mouseleave="overlayGas = false" :class="overlayGas &amp;&amp; 'is-active'" x-cloak>
                        <div class="hero__subtitle">Газоснабжение</div>
                        <ul class="hero__list list-reset">
                            <li class="hero__item">
                                <a class="hero__link" href="javascript:void(0)">Фитинги элекстросварные FRIALEN</a>
                            </li>
                            <li class="hero__item">
                                <a class="hero__link" href="javascript:void(0)">Литые фитинги</a>
                            </li>
                            <li class="hero__item">
                                <a class="hero__link" href="javascript:void(0)">Оборудование и инструменты FIATOOLS</a>
                            </li>
                            <li class="hero__item">
                                <a class="hero__link" href="javascript:void(0)">Аппараты для стыковой сварки HY-RAM</a>
                            </li>
                            <li class="hero__item">
                                <a class="hero__link" href="javascript:void(0)">Ремонтные хомуты STRAUB</a>
                            </li>
                            <li class="hero__item">
                                <a class="hero__link" href="javascript:void(0)">Переходы сталь-полиэтилен ИЗОПАЙН</a>
                            </li>
                            <li class="hero__item">
                                <a class="hero__link" href="javascript:void(0)">Цокольные вводы ИЗОПАЙН</a>
                            </li>
                            <li class="hero__item">
                                <a class="hero__link" href="javascript:void(0)">Трубы ПНД</a>
                            </li>
                            <li class="hero__item">
                                <a class="hero__link" href="javascript:void(0)">Вспомогательное оборудование Caldervale</a>
                            </li>
                            <li class="hero__item">
                                <a class="hero__link" href="javascript:void(0)">Медные фитинги Conex Banninger</a>
                            </li>
                            <li class="hero__item">
                                <a class="hero__link" href="javascript:void(0)">Инструменты и приспособления HY-RAM</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- ._way-->
                <div class="hero__way hero__way--water lazy" data-bg="/static/images/common/hero-bg-2.webp" x-data="{ overlayWater: false }">
                    <div class="hero__title">Водоснабжение</div>
                    <div class="hero__text">Большой ассортимент для газоснабжения: от фитингов и муфт до полиэтиленовой трубы и ГРПШ. Большой выбор счетчиков, сигнализаторов, фильтров.</div>
                    <div class="hero__btn" @mouseover="overlayWater = true">
                        <svg class="svg-sprite-icon icon-plus" width="1em" height="1em">
                            <use xlink:href="/static/images/sprite/symbol/sprite.svg#plus"></use>
                        </svg>
                    </div>
                    <div class="hero__overlay" @mouseleave="overlayWater = false" :class="overlayWater &amp;&amp; 'is-active'" x-cloak>
                        <div class="hero__subtitle">Водоснабжение</div>
                        <ul class="hero__list list-reset">
                            <li class="hero__item">
                                <a class="hero__link" href="javascript:void(0)">Пластиковые трубы</a>
                            </li>
                            <li class="hero__item">
                                <a class="hero__link" href="javascript:void(0)">Чугунные трубы</a>
                            </li>
                            <li class="hero__item">
                                <a class="hero__link" href="javascript:void(0)">Трубы в изоляции (ВУС, ППУ, ППМ)</a>
                            </li>
                            <li class="hero__item">
                                <a class="hero__link" href="javascript:void(0)">Фитинги ПНД для труб скопировать в фриален газ</a>
                            </li>
                            <li class="hero__item">
                                <a class="hero__link" href="javascript:void(0)">Литые фитинги + копия в газ</a>
                            </li>
                            <li class="hero__item">
                                <a class="hero__link" href="javascript:void(0)">Запорная арматура</a>
                            </li>
                            <li class="hero__item">
                                <a class="hero__link" href="javascript:void(0)">Фланцы</a>
                            </li>
                            <li class="hero__item">
                                <a class="hero__link" href="javascript:void(0)">Ремонтно-соединительная арматура</a>
                            </li>
                            <li class="hero__item">
                                <a class="hero__link" href="javascript:void(0)">Пожарное оборудование</a>
                            </li>
                            <li class="hero__item">
                                <a class="hero__link" href="javascript:void(0)">Опорно-направляющие кольца и герметизирующие манжеты</a>
                            </li>
                            <li class="hero__item">
                                <a class="hero__link" href="javascript:void(0)">Фильтрующие патроны</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- .container-->
        <div class="hero__container container">
            <div class="hero__slider swiper" data-hero-slider>
                <div class="hero__wrapper swiper-wrapper">
                    <!-- --medium-->
                    <div class="hero__slide hero__slide--medium swiper-slide">
                        <a class="hero__video" href="https://www.youtube.com/watch?v=m3s93lws-WM" data-popup>
                            <picture>
                                <source srcset="/" data-srcset="/static/images/common/slide-1.webp" type="image/webp">
                                <img class="hero__pic lazy" src="/" data-src="/static/images/common/slide-1.png" width="380" height="270" alt="">
                            </picture>
                        </a>
                    </div>
                    <!-- --small-->
                    <div class="hero__slide hero__slide--image hero__slide--small swiper-slide">
                        <a class="hero__video" href="/static/images/common/slide-2.png" data-popup>
                            <picture>
                                <source srcset="/" data-srcset="/static/images/common/slide-2.webp" type="image/webp">
                                <img class="hero__pic lazy" src="/" data-src="/static/images/common/slide-2.png" width="278" height="270" alt="">
                            </picture>
                        </a>
                    </div>
                    <!-- ._slide-->
                    <div class="hero__slide swiper-slide">
                        <a class="hero__video" href="https://www.youtube.com/watch?v=htnobkrtDoo" data-popup>
                            <picture>
                                <source srcset="/" data-srcset="/static/images/common/slide-3.webp" type="image/webp">
                                <img class="hero__pic lazy" src="/" data-src="/static/images/common/slide-3.png" width="482" height="270" alt="">
                            </picture>
                        </a>
                    </div>
                    <!-- --medium-->
                    <div class="hero__slide hero__slide--medium swiper-slide">
                        <a class="hero__video" href="https://www.youtube.com/watch?v=m3s93lws-WM" data-popup>
                            <picture>
                                <source srcset="/" data-srcset="/static/images/common/slide-1.webp" type="image/webp">
                                <img class="hero__pic lazy" src="/" data-src="/static/images/common/slide-1.png" width="380" height="270" alt="">
                            </picture>
                        </a>
                    </div>
                    <!-- --small-->
                    <div class="hero__slide hero__slide--image hero__slide--small swiper-slide">
                        <a class="hero__video" href="/static/images/common/slide-2.png" data-popup>
                            <picture>
                                <source srcset="/" data-srcset="/static/images/common/slide-2.webp" type="image/webp">
                                <img class="hero__pic lazy" src="/" data-src="/static/images/common/slide-2.png" width="278" height="270" alt="">
                            </picture>
                        </a>
                    </div>
                    <!-- ._slide-->
                    <div class="hero__slide swiper-slide">
                        <a class="hero__video" href="https://www.youtube.com/watch?v=htnobkrtDoo" data-popup>
                            <picture>
                                <source srcset="/" data-srcset="/static/images/common/slide-3.webp" type="image/webp">
                                <img class="hero__pic lazy" src="/" data-src="/static/images/common/slide-3.png" width="482" height="270" alt="">
                            </picture>
                        </a>
                    </div>
                    <!-- --medium-->
                    <div class="hero__slide hero__slide--medium swiper-slide">
                        <a class="hero__video" href="https://www.youtube.com/watch?v=m3s93lws-WM" data-popup>
                            <picture>
                                <source srcset="/" data-srcset="/static/images/common/slide-1.webp" type="image/webp">
                                <img class="hero__pic lazy" src="/" data-src="/static/images/common/slide-1.png" width="380" height="270" alt="">
                            </picture>
                        </a>
                    </div>
                    <!-- --small-->
                    <div class="hero__slide hero__slide--image hero__slide--small swiper-slide">
                        <a class="hero__video" href="/static/images/common/slide-2.png" data-popup>
                            <picture>
                                <source srcset="/" data-srcset="/static/images/common/slide-2.webp" type="image/webp">
                                <img class="hero__pic lazy" src="/" data-src="/static/images/common/slide-2.png" width="278" height="270" alt="">
                            </picture>
                        </a>
                    </div>
                    <!-- ._slide-->
                    <div class="hero__slide swiper-slide">
                        <a class="hero__video" href="https://www.youtube.com/watch?v=htnobkrtDoo" data-popup>
                            <picture>
                                <source srcset="/" data-srcset="/static/images/common/slide-3.webp" type="image/webp">
                                <img class="hero__pic lazy" src="/" data-src="/static/images/common/slide-3.png" width="482" height="270" alt="">
                            </picture>
                        </a>
                    </div>
                </div>
            </div>
            <div class="slider-nav">
                <div class="slider-nav__btn slider-nav__btn--prev" data-hero-slider-prev>
                    <svg class="svg-sprite-icon icon-arrow-left" width="1em" height="1em">
                        <use xlink:href="/static/images/sprite/symbol/sprite.svg#arrow-left"></use>
                    </svg>
                </div>
                <div class="slider-nav__btn slider-nav__btn--next" data-hero-slider-next>
                    <svg class="svg-sprite-icon icon-arrow-right" width="1em" height="1em">
                        <use xlink:href="/static/images/sprite/symbol/sprite.svg#arrow-right"></use>
                    </svg>
                </div>
            </div>
        </div>
    </section>
    <section class="s-categories">
        <div class="s-categories__wrapper container container--wide">
            <div class="s-categories__container container">
                <div class="s-categories__title">Популярные категории</div>
                <div class="s-categories__grid">
                    <!-- ._card.-medium-->
                    <div class="s-categories__card s-categories__card--medium">
                        <a class="s-categories__subtitle" href="javascript:void(0)">Фитинги электросварные FRIALEN</a>
                        <a href="javascript:void(0)" title="Фитинги электросварные FRIALEN">
                            <picture>
                                <source srcset="/" data-srcset="/static/images/common/card-1.webp" type="image/webp" />
                                <img class="s-categories__pic lazy" src="/" data-src="/static/images/common/card-1.png" width="163" height="163" alt="" />
                            </picture>
                        </a>
                        <a class="s-categories__sublink" href="javascript:void(0)">
                            <span>Подробнее</span>
                            <svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.495 6.49497C20.7683 6.22161 20.7683 5.77839 20.495 5.50503L16.0402 1.05025C15.7668 0.776886 15.3236 0.776886 15.0503 1.05025C14.7769 1.32362 14.7769 1.76684 15.0503 2.0402L19.01 6L15.0503 9.9598C14.7769 10.2332 14.7769 10.6764 15.0503 10.9497C15.3236 11.2231 15.7668 11.2231 16.0402 10.9497L20.495 6.49497ZM0 6.7H20V5.3H0V6.7Z"
                                      fill="currentColor" />
                            </svg>
                        </a>
                    </div>
                    <!-- ._card.-small-->
                    <div class="s-categories__card s-categories__card--small">
                        <a class="s-categories__subtitle" href="javascript:void(0)">Литые фитинги</a>
                        <a href="javascript:void(0)" title="Литые фитинги">
                            <picture>
                                <source srcset="/" data-srcset="/static/images/common/card-2.webp" type="image/webp" />
                                <img class="s-categories__pic lazy" src="/" data-src="/static/images/common/card-2.png" width="115" height="145" alt="" />
                            </picture>
                        </a>
                        <a class="s-categories__sublink" href="javascript:void(0)">
                            <span>Подробнее</span>
                            <svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.495 6.49497C20.7683 6.22161 20.7683 5.77839 20.495 5.50503L16.0402 1.05025C15.7668 0.776886 15.3236 0.776886 15.0503 1.05025C14.7769 1.32362 14.7769 1.76684 15.0503 2.0402L19.01 6L15.0503 9.9598C14.7769 10.2332 14.7769 10.6764 15.0503 10.9497C15.3236 11.2231 15.7668 11.2231 16.0402 10.9497L20.495 6.49497ZM0 6.7H20V5.3H0V6.7Z"
                                      fill="currentColor" />
                            </svg>
                        </a>
                    </div>
                    <!-- ._card-->
                    <div class="s-categories__card">
                        <a class="s-categories__subtitle" href="javascript:void(0)">Оборудование и инструменты FIATOOLS</a>
                        <a href="javascript:void(0)" title="Оборудование и инструменты FIATOOLS">
                            <picture>
                                <source srcset="/" data-srcset="/static/images/common/card-3.webp" type="image/webp" />
                                <img class="s-categories__pic lazy" src="/" data-src="/static/images/common/card-3.png" width="234" height="210" alt="" />
                            </picture>
                        </a>
                        <a class="s-categories__sublink" href="javascript:void(0)">
                            <span>Подробнее</span>
                            <svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.495 6.49497C20.7683 6.22161 20.7683 5.77839 20.495 5.50503L16.0402 1.05025C15.7668 0.776886 15.3236 0.776886 15.0503 1.05025C14.7769 1.32362 14.7769 1.76684 15.0503 2.0402L19.01 6L15.0503 9.9598C14.7769 10.2332 14.7769 10.6764 15.0503 10.9497C15.3236 11.2231 15.7668 11.2231 16.0402 10.9497L20.495 6.49497ZM0 6.7H20V5.3H0V6.7Z"
                                      fill="currentColor" />
                            </svg>
                        </a>
                    </div>
                    <!-- ._card-->
                    <div class="s-categories__card">
                        <a class="s-categories__subtitle" href="javascript:void(0)">Аппараты для стыковой сварки HY-RAM</a>
                        <a href="javascript:void(0)" title="Аппараты для стыковой сварки HY-RAM">
                            <picture>
                                <source srcset="/" data-srcset="/static/images/common/card-4.webp" type="image/webp" />
                                <img class="s-categories__pic lazy" src="/" data-src="/static/images/common/card-4.png" width="216" height="152" alt="" />
                            </picture>
                        </a>
                        <a class="s-categories__sublink" href="javascript:void(0)">
                            <span>Подробнее</span>
                            <svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.495 6.49497C20.7683 6.22161 20.7683 5.77839 20.495 5.50503L16.0402 1.05025C15.7668 0.776886 15.3236 0.776886 15.0503 1.05025C14.7769 1.32362 14.7769 1.76684 15.0503 2.0402L19.01 6L15.0503 9.9598C14.7769 10.2332 14.7769 10.6764 15.0503 10.9497C15.3236 11.2231 15.7668 11.2231 16.0402 10.9497L20.495 6.49497ZM0 6.7H20V5.3H0V6.7Z"
                                      fill="currentColor" />
                            </svg>
                        </a>
                    </div>
                    <!-- ._card.-medium-->
                    <div class="s-categories__card s-categories__card--medium">
                        <a class="s-categories__subtitle" href="javascript:void(0)">Переходы сталь-полиэтилен ИЗОПАЙН</a>
                        <a href="javascript:void(0)" title="Переходы сталь-полиэтилен ИЗОПАЙН">
                            <picture>
                                <source srcset="/" data-srcset="/static/images/common/card-5.webp" type="image/webp" />
                                <img class="s-categories__pic lazy" src="/" data-src="/static/images/common/card-5.png" width="148" height="148" alt="" />
                            </picture>
                        </a>
                        <a class="s-categories__sublink" href="javascript:void(0)">
                            <span>Подробнее</span>
                            <svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.495 6.49497C20.7683 6.22161 20.7683 5.77839 20.495 5.50503L16.0402 1.05025C15.7668 0.776886 15.3236 0.776886 15.0503 1.05025C14.7769 1.32362 14.7769 1.76684 15.0503 2.0402L19.01 6L15.0503 9.9598C14.7769 10.2332 14.7769 10.6764 15.0503 10.9497C15.3236 11.2231 15.7668 11.2231 16.0402 10.9497L20.495 6.49497ZM0 6.7H20V5.3H0V6.7Z"
                                      fill="currentColor" />
                            </svg>
                        </a>
                    </div>
                    <!-- ._card.-small-->
                    <div class="s-categories__card s-categories__card--small">
                        <a class="s-categories__subtitle" href="javascript:void(0)">Ремонтные хомуты STRAUB</a>
                        <a href="javascript:void(0)" title="Ремонтные хомуты STRAUB">
                            <picture>
                                <source srcset="/" data-srcset="/static/images/common/card-6.webp" type="image/webp" />
                                <img class="s-categories__pic lazy" src="/" data-src="/static/images/common/card-6.png" width="149" height="149" alt="" />
                            </picture>
                        </a>
                        <a class="s-categories__sublink" href="javascript:void(0)">
                            <span>Подробнее</span>
                            <svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.495 6.49497C20.7683 6.22161 20.7683 5.77839 20.495 5.50503L16.0402 1.05025C15.7668 0.776886 15.3236 0.776886 15.0503 1.05025C14.7769 1.32362 14.7769 1.76684 15.0503 2.0402L19.01 6L15.0503 9.9598C14.7769 10.2332 14.7769 10.6764 15.0503 10.9497C15.3236 11.2231 15.7668 11.2231 16.0402 10.9497L20.495 6.49497ZM0 6.7H20V5.3H0V6.7Z"
                                      fill="currentColor" />
                            </svg>
                        </a>
                    </div>
                    <!-- ._card.-small-->
                    <div class="s-categories__card s-categories__card--small">
                        <a class="s-categories__subtitle" href="javascript:void(0)">Литые фитинги</a>
                        <a href="javascript:void(0)" title="Литые фитинги">
                            <picture>
                                <source srcset="/" data-srcset="/static/images/common/card-7.webp" type="image/webp" />
                                <img class="s-categories__pic lazy" src="/" data-src="/static/images/common/card-7.png" width="155" height="155" alt="" />
                            </picture>
                        </a>
                        <a class="s-categories__sublink" href="javascript:void(0)">
                            <span>Подробнее</span>
                            <svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.495 6.49497C20.7683 6.22161 20.7683 5.77839 20.495 5.50503L16.0402 1.05025C15.7668 0.776886 15.3236 0.776886 15.0503 1.05025C14.7769 1.32362 14.7769 1.76684 15.0503 2.0402L19.01 6L15.0503 9.9598C14.7769 10.2332 14.7769 10.6764 15.0503 10.9497C15.3236 11.2231 15.7668 11.2231 16.0402 10.9497L20.495 6.49497ZM0 6.7H20V5.3H0V6.7Z"
                                      fill="currentColor" />
                            </svg>
                        </a>
                    </div>
                    <!-- ._card-->
                    <div class="s-categories__card">
                        <a class="s-categories__subtitle" href="javascript:void(0)">Оборудование и инструменты FIATOOLS</a>
                        <a href="javascript:void(0)" title="Оборудование и инструменты FIATOOLS">
                            <picture>
                                <source srcset="/" data-srcset="/static/images/common/card-8.webp" type="image/webp" />
                                <img class="s-categories__pic lazy" src="/" data-src="/static/images/common/card-8.png" width="225" height="213" alt="" />
                            </picture>
                        </a>
                        <a class="s-categories__sublink" href="javascript:void(0)">
                            <span>Подробнее</span>
                            <svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.495 6.49497C20.7683 6.22161 20.7683 5.77839 20.495 5.50503L16.0402 1.05025C15.7668 0.776886 15.3236 0.776886 15.0503 1.05025C14.7769 1.32362 14.7769 1.76684 15.0503 2.0402L19.01 6L15.0503 9.9598C14.7769 10.2332 14.7769 10.6764 15.0503 10.9497C15.3236 11.2231 15.7668 11.2231 16.0402 10.9497L20.495 6.49497ZM0 6.7H20V5.3H0V6.7Z"
                                      fill="currentColor" />
                            </svg>
                        </a>
                    </div>
                    <!-- ._card.-medium-->
                    <div class="s-categories__card s-categories__card--medium">
                        <a class="s-categories__subtitle" href="javascript:void(0)">Фитинги элекстросварные FRIALEN</a>
                        <a href="javascript:void(0)" title="Фитинги элекстросварные FRIALEN">
                            <picture>
                                <source srcset="/" data-srcset="/static/images/common/card-9.webp" type="image/webp" />
                                <img class="s-categories__pic lazy" src="/" data-src="/static/images/common/card-9.png" width="242" height="181" alt="" />
                            </picture>
                        </a>
                        <a class="s-categories__sublink" href="javascript:void(0)">
                            <span>Подробнее</span>
                            <svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.495 6.49497C20.7683 6.22161 20.7683 5.77839 20.495 5.50503L16.0402 1.05025C15.7668 0.776886 15.3236 0.776886 15.0503 1.05025C14.7769 1.32362 14.7769 1.76684 15.0503 2.0402L19.01 6L15.0503 9.9598C14.7769 10.2332 14.7769 10.6764 15.0503 10.9497C15.3236 11.2231 15.7668 11.2231 16.0402 10.9497L20.495 6.49497ZM0 6.7H20V5.3H0V6.7Z"
                                      fill="currentColor" />
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="s-categories__action">
                    <a class="s-categories__link" href="javascript:void(0)" title="Все категории">
                        <span>Все категории</span>
                        <svg width="31" height="12" viewBox="0 0 31 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M30.495 6.49497C30.7683 6.22161 30.7683 5.77839 30.495 5.50503L26.0402 1.05025C25.7668 0.776886 25.3236 0.776886 25.0503 1.05025C24.7769 1.32362 24.7769 1.76684 25.0503 2.0402L29.0101 6L25.0503 9.9598C24.7769 10.2332 24.7769 10.6764 25.0503 10.9497C25.3236 11.2231 25.7668 11.2231 26.0402 10.9497L30.495 6.49497ZM0 6.7H30V5.3H0V6.7Z"
                                  fill="currentColor" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="s-specials" x-data="{ currentView: 'Газоснабжение' }">
        <div class="s-specials__container container">
            <div class="s-specials__title">Акции и спецпредложения</div>
            <!-- ._tabs-->
            <div class="s-specials__tabs">
                <div class="s-specials__tab" @click="currentView = 'Газоснабжение'" :class="currentView == 'Газоснабжение' &amp;&amp; 'is-active'">Газоснабжение</div>
                <div class="s-specials__tab" @click="currentView = 'Водоснабжение'" :class="currentView == 'Водоснабжение' &amp;&amp; 'is-active'">Водоснабжение</div>
            </div>
            <div class="s-specials__views">
                <!-- ._view: Газоснабжение-->
                <div class="s-specials__view swiper" x-show="currentView == 'Газоснабжение'" data-gas-slider x-cloak>
                    <div class="s-specials__wrapper swiper-wrapper">
                        <div class="s-specials__slide swiper-slide">
                            <div class="s-card">
                                <div class="s-card__badge">Акция</div>
                                <a class="s-card__preview" href="javascript:void(0)" title="Муфты Frialen UB без упора, SDR 11, SDR 17">
                                    <picture>
                                        <source srcset="/" data-srcset="/static/images/common/card-1.webp" type="image/webp" />
                                        <img class="s-card__pic lazy" src="/" data-src="/static/images/common/card-1.png" width="146" height="146" alt="" />
                                    </picture>
                                </a>
                                <a class="s-card__title" href="javascript:void(0)">Муфты Frialen UB без упора, SDR 11, SDR 17</a>
                                <!--._pricing-->
                                <!--  ._price= price + ' ₽'-->
                                <!--  ._ofcount / 1 шт-->
                                <a class="s-card__link" href="javascript:void(0)" title="Подробнее">
                                    <span>Подробнее</span>
                                    <svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.495 6.49497C20.7683 6.22161 20.7683 5.77839 20.495 5.50503L16.0402 1.05025C15.7668 0.776886 15.3236 0.776886 15.0503 1.05025C14.7769 1.32362 14.7769 1.76684 15.0503 2.0402L19.01 6L15.0503 9.9598C14.7769 10.2332 14.7769 10.6764 15.0503 10.9497C15.3236 11.2231 15.7668 11.2231 16.0402 10.9497L20.495 6.49497ZM0 6.7H20V5.3H0V6.7Z"
                                              fill="currentColor" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="s-specials__slide swiper-slide">
                            <div class="s-card">
                                <div class="s-card__badge">Акция</div>
                                <a class="s-card__preview" href="javascript:void(0)" title="Угольник латунь Дн16 RM122 пресс (200/10) Giacomini RM122Y003">
                                    <picture>
                                        <source srcset="/" data-srcset="/static/images/common/card-2.webp" type="image/webp" />
                                        <img class="s-card__pic lazy" src="/" data-src="/static/images/common/card-2.png" width="146" height="146" alt="" />
                                    </picture>
                                </a>
                                <a class="s-card__title" href="javascript:void(0)">Угольник латунь Дн16 RM122 пресс (200/10) Giacomini RM122Y003</a>
                                <!--._pricing-->
                                <!--  ._price= price + ' ₽'-->
                                <!--  ._ofcount / 1 шт-->
                                <a class="s-card__link" href="javascript:void(0)" title="Подробнее">
                                    <span>Подробнее</span>
                                    <svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.495 6.49497C20.7683 6.22161 20.7683 5.77839 20.495 5.50503L16.0402 1.05025C15.7668 0.776886 15.3236 0.776886 15.0503 1.05025C14.7769 1.32362 14.7769 1.76684 15.0503 2.0402L19.01 6L15.0503 9.9598C14.7769 10.2332 14.7769 10.6764 15.0503 10.9497C15.3236 11.2231 15.7668 11.2231 16.0402 10.9497L20.495 6.49497ZM0 6.7H20V5.3H0V6.7Z"
                                              fill="currentColor" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="s-specials__slide swiper-slide">
                            <div class="s-card">
                                <div class="s-card__badge">Акция</div>
                                <a class="s-card__preview" href="javascript:void(0)" title="Цилиндр минеральная вата 89/50 L=1м 650С желтый ROCKWOOL">
                                    <picture>
                                        <source srcset="/" data-srcset="/static/images/common/card-3.webp" type="image/webp" />
                                        <img class="s-card__pic lazy" src="/" data-src="/static/images/common/card-3.png" width="146" height="146" alt="" />
                                    </picture>
                                </a>
                                <a class="s-card__title" href="javascript:void(0)">Цилиндр минеральная вата 89/50 L=1м 650С желтый ROCKWOOL</a>
                                <!--._pricing-->
                                <!--  ._price= price + ' ₽'-->
                                <!--  ._ofcount / 1 шт-->
                                <a class="s-card__link" href="javascript:void(0)" title="Подробнее">
                                    <span>Подробнее</span>
                                    <svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.495 6.49497C20.7683 6.22161 20.7683 5.77839 20.495 5.50503L16.0402 1.05025C15.7668 0.776886 15.3236 0.776886 15.0503 1.05025C14.7769 1.32362 14.7769 1.76684 15.0503 2.0402L19.01 6L15.0503 9.9598C14.7769 10.2332 14.7769 10.6764 15.0503 10.9497C15.3236 11.2231 15.7668 11.2231 16.0402 10.9497L20.495 6.49497ZM0 6.7H20V5.3H0V6.7Z"
                                              fill="currentColor" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="s-specials__slide swiper-slide">
                            <div class="s-card">
                                <div class="s-card__badge">Акция</div>
                                <a class="s-card__preview" href="javascript:void(0)" title="Задвижка 31лс41нж сталь 09Г2С Ду50 Ру16 с КОФ ИКАР">
                                    <picture>
                                        <source srcset="/" data-srcset="/static/images/common/card-4.webp" type="image/webp" />
                                        <img class="s-card__pic lazy" src="/" data-src="/static/images/common/card-4.png" width="146" height="146" alt="" />
                                    </picture>
                                </a>
                                <a class="s-card__title" href="javascript:void(0)">Задвижка 31лс41нж сталь 09Г2С Ду50 Ру16 с КОФ ИКАР</a>
                                <!--._pricing-->
                                <!--  ._price= price + ' ₽'-->
                                <!--  ._ofcount / 1 шт-->
                                <a class="s-card__link" href="javascript:void(0)" title="Подробнее">
                                    <span>Подробнее</span>
                                    <svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.495 6.49497C20.7683 6.22161 20.7683 5.77839 20.495 5.50503L16.0402 1.05025C15.7668 0.776886 15.3236 0.776886 15.0503 1.05025C14.7769 1.32362 14.7769 1.76684 15.0503 2.0402L19.01 6L15.0503 9.9598C14.7769 10.2332 14.7769 10.6764 15.0503 10.9497C15.3236 11.2231 15.7668 11.2231 16.0402 10.9497L20.495 6.49497ZM0 6.7H20V5.3H0V6.7Z"
                                              fill="currentColor" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="s-specials__slide swiper-slide">
                            <div class="s-card">
                                <div class="s-card__badge">Акция</div>
                                <a class="s-card__preview" href="javascript:void(0)" title="Муфты Frialen UB без упора, SDR 11, SDR 17">
                                    <picture>
                                        <source srcset="/" data-srcset="/static/images/common/card-1.webp" type="image/webp" />
                                        <img class="s-card__pic lazy" src="/" data-src="/static/images/common/card-1.png" width="146" height="146" alt="" />
                                    </picture>
                                </a>
                                <a class="s-card__title" href="javascript:void(0)">Муфты Frialen UB без упора, SDR 11, SDR 17</a>
                                <!--._pricing-->
                                <!--  ._price= price + ' ₽'-->
                                <!--  ._ofcount / 1 шт-->
                                <a class="s-card__link" href="javascript:void(0)" title="Подробнее">
                                    <span>Подробнее</span>
                                    <svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.495 6.49497C20.7683 6.22161 20.7683 5.77839 20.495 5.50503L16.0402 1.05025C15.7668 0.776886 15.3236 0.776886 15.0503 1.05025C14.7769 1.32362 14.7769 1.76684 15.0503 2.0402L19.01 6L15.0503 9.9598C14.7769 10.2332 14.7769 10.6764 15.0503 10.9497C15.3236 11.2231 15.7668 11.2231 16.0402 10.9497L20.495 6.49497ZM0 6.7H20V5.3H0V6.7Z"
                                              fill="currentColor" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="s-specials__slide swiper-slide">
                            <div class="s-card">
                                <div class="s-card__badge">Акция</div>
                                <a class="s-card__preview" href="javascript:void(0)" title="Угольник латунь Дн16 RM122 пресс (200/10) Giacomini RM122Y003">
                                    <picture>
                                        <source srcset="/" data-srcset="/static/images/common/card-2.webp" type="image/webp" />
                                        <img class="s-card__pic lazy" src="/" data-src="/static/images/common/card-2.png" width="146" height="146" alt="" />
                                    </picture>
                                </a>
                                <a class="s-card__title" href="javascript:void(0)">Угольник латунь Дн16 RM122 пресс (200/10) Giacomini RM122Y003</a>
                                <!--._pricing-->
                                <!--  ._price= price + ' ₽'-->
                                <!--  ._ofcount / 1 шт-->
                                <a class="s-card__link" href="javascript:void(0)" title="Подробнее">
                                    <span>Подробнее</span>
                                    <svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.495 6.49497C20.7683 6.22161 20.7683 5.77839 20.495 5.50503L16.0402 1.05025C15.7668 0.776886 15.3236 0.776886 15.0503 1.05025C14.7769 1.32362 14.7769 1.76684 15.0503 2.0402L19.01 6L15.0503 9.9598C14.7769 10.2332 14.7769 10.6764 15.0503 10.9497C15.3236 11.2231 15.7668 11.2231 16.0402 10.9497L20.495 6.49497ZM0 6.7H20V5.3H0V6.7Z"
                                              fill="currentColor" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="s-specials__slide swiper-slide">
                            <div class="s-card">
                                <div class="s-card__badge">Акция</div>
                                <a class="s-card__preview" href="javascript:void(0)" title="Цилиндр минеральная вата 89/50 L=1м 650С желтый ROCKWOOL">
                                    <picture>
                                        <source srcset="/" data-srcset="/static/images/common/card-3.webp" type="image/webp" />
                                        <img class="s-card__pic lazy" src="/" data-src="/static/images/common/card-3.png" width="146" height="146" alt="" />
                                    </picture>
                                </a>
                                <a class="s-card__title" href="javascript:void(0)">Цилиндр минеральная вата 89/50 L=1м 650С желтый ROCKWOOL</a>
                                <!--._pricing-->
                                <!--  ._price= price + ' ₽'-->
                                <!--  ._ofcount / 1 шт-->
                                <a class="s-card__link" href="javascript:void(0)" title="Подробнее">
                                    <span>Подробнее</span>
                                    <svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.495 6.49497C20.7683 6.22161 20.7683 5.77839 20.495 5.50503L16.0402 1.05025C15.7668 0.776886 15.3236 0.776886 15.0503 1.05025C14.7769 1.32362 14.7769 1.76684 15.0503 2.0402L19.01 6L15.0503 9.9598C14.7769 10.2332 14.7769 10.6764 15.0503 10.9497C15.3236 11.2231 15.7668 11.2231 16.0402 10.9497L20.495 6.49497ZM0 6.7H20V5.3H0V6.7Z"
                                              fill="currentColor" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="s-specials__slide swiper-slide">
                            <div class="s-card">
                                <div class="s-card__badge">Акция</div>
                                <a class="s-card__preview" href="javascript:void(0)" title="Задвижка 31лс41нж сталь 09Г2С Ду50 Ру16 с КОФ ИКАР">
                                    <picture>
                                        <source srcset="/" data-srcset="/static/images/common/card-4.webp" type="image/webp" />
                                        <img class="s-card__pic lazy" src="/" data-src="/static/images/common/card-4.png" width="146" height="146" alt="" />
                                    </picture>
                                </a>
                                <a class="s-card__title" href="javascript:void(0)">Задвижка 31лс41нж сталь 09Г2С Ду50 Ру16 с КОФ ИКАР</a>
                                <!--._pricing-->
                                <!--  ._price= price + ' ₽'-->
                                <!--  ._ofcount / 1 шт-->
                                <a class="s-card__link" href="javascript:void(0)" title="Подробнее">
                                    <span>Подробнее</span>
                                    <svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.495 6.49497C20.7683 6.22161 20.7683 5.77839 20.495 5.50503L16.0402 1.05025C15.7668 0.776886 15.3236 0.776886 15.0503 1.05025C14.7769 1.32362 14.7769 1.76684 15.0503 2.0402L19.01 6L15.0503 9.9598C14.7769 10.2332 14.7769 10.6764 15.0503 10.9497C15.3236 11.2231 15.7668 11.2231 16.0402 10.9497L20.495 6.49497ZM0 6.7H20V5.3H0V6.7Z"
                                              fill="currentColor" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="s-specials__slide swiper-slide">
                            <div class="s-card">
                                <div class="s-card__badge">Акция</div>
                                <a class="s-card__preview" href="javascript:void(0)" title="Муфты Frialen UB без упора, SDR 11, SDR 17">
                                    <picture>
                                        <source srcset="/" data-srcset="/static/images/common/card-1.webp" type="image/webp" />
                                        <img class="s-card__pic lazy" src="/" data-src="/static/images/common/card-1.png" width="146" height="146" alt="" />
                                    </picture>
                                </a>
                                <a class="s-card__title" href="javascript:void(0)">Муфты Frialen UB без упора, SDR 11, SDR 17</a>
                                <!--._pricing-->
                                <!--  ._price= price + ' ₽'-->
                                <!--  ._ofcount / 1 шт-->
                                <a class="s-card__link" href="javascript:void(0)" title="Подробнее">
                                    <span>Подробнее</span>
                                    <svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.495 6.49497C20.7683 6.22161 20.7683 5.77839 20.495 5.50503L16.0402 1.05025C15.7668 0.776886 15.3236 0.776886 15.0503 1.05025C14.7769 1.32362 14.7769 1.76684 15.0503 2.0402L19.01 6L15.0503 9.9598C14.7769 10.2332 14.7769 10.6764 15.0503 10.9497C15.3236 11.2231 15.7668 11.2231 16.0402 10.9497L20.495 6.49497ZM0 6.7H20V5.3H0V6.7Z"
                                              fill="currentColor" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="s-specials__slide swiper-slide">
                            <div class="s-card">
                                <div class="s-card__badge">Акция</div>
                                <a class="s-card__preview" href="javascript:void(0)" title="Угольник латунь Дн16 RM122 пресс (200/10) Giacomini RM122Y003">
                                    <picture>
                                        <source srcset="/" data-srcset="/static/images/common/card-2.webp" type="image/webp" />
                                        <img class="s-card__pic lazy" src="/" data-src="/static/images/common/card-2.png" width="146" height="146" alt="" />
                                    </picture>
                                </a>
                                <a class="s-card__title" href="javascript:void(0)">Угольник латунь Дн16 RM122 пресс (200/10) Giacomini RM122Y003</a>
                                <!--._pricing-->
                                <!--  ._price= price + ' ₽'-->
                                <!--  ._ofcount / 1 шт-->
                                <a class="s-card__link" href="javascript:void(0)" title="Подробнее">
                                    <span>Подробнее</span>
                                    <svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.495 6.49497C20.7683 6.22161 20.7683 5.77839 20.495 5.50503L16.0402 1.05025C15.7668 0.776886 15.3236 0.776886 15.0503 1.05025C14.7769 1.32362 14.7769 1.76684 15.0503 2.0402L19.01 6L15.0503 9.9598C14.7769 10.2332 14.7769 10.6764 15.0503 10.9497C15.3236 11.2231 15.7668 11.2231 16.0402 10.9497L20.495 6.49497ZM0 6.7H20V5.3H0V6.7Z"
                                              fill="currentColor" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="s-specials__slide swiper-slide">
                            <div class="s-card">
                                <div class="s-card__badge">Акция</div>
                                <a class="s-card__preview" href="javascript:void(0)" title="Цилиндр минеральная вата 89/50 L=1м 650С желтый ROCKWOOL">
                                    <picture>
                                        <source srcset="/" data-srcset="/static/images/common/card-3.webp" type="image/webp" />
                                        <img class="s-card__pic lazy" src="/" data-src="/static/images/common/card-3.png" width="146" height="146" alt="" />
                                    </picture>
                                </a>
                                <a class="s-card__title" href="javascript:void(0)">Цилиндр минеральная вата 89/50 L=1м 650С желтый ROCKWOOL</a>
                                <!--._pricing-->
                                <!--  ._price= price + ' ₽'-->
                                <!--  ._ofcount / 1 шт-->
                                <a class="s-card__link" href="javascript:void(0)" title="Подробнее">
                                    <span>Подробнее</span>
                                    <svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.495 6.49497C20.7683 6.22161 20.7683 5.77839 20.495 5.50503L16.0402 1.05025C15.7668 0.776886 15.3236 0.776886 15.0503 1.05025C14.7769 1.32362 14.7769 1.76684 15.0503 2.0402L19.01 6L15.0503 9.9598C14.7769 10.2332 14.7769 10.6764 15.0503 10.9497C15.3236 11.2231 15.7668 11.2231 16.0402 10.9497L20.495 6.49497ZM0 6.7H20V5.3H0V6.7Z"
                                              fill="currentColor" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="s-specials__slide swiper-slide">
                            <div class="s-card">
                                <div class="s-card__badge">Акция</div>
                                <a class="s-card__preview" href="javascript:void(0)" title="Задвижка 31лс41нж сталь 09Г2С Ду50 Ру16 с КОФ ИКАР">
                                    <picture>
                                        <source srcset="/" data-srcset="/static/images/common/card-4.webp" type="image/webp" />
                                        <img class="s-card__pic lazy" src="/" data-src="/static/images/common/card-4.png" width="146" height="146" alt="" />
                                    </picture>
                                </a>
                                <a class="s-card__title" href="javascript:void(0)">Задвижка 31лс41нж сталь 09Г2С Ду50 Ру16 с КОФ ИКАР</a>
                                <!--._pricing-->
                                <!--  ._price= price + ' ₽'-->
                                <!--  ._ofcount / 1 шт-->
                                <a class="s-card__link" href="javascript:void(0)" title="Подробнее">
                                    <span>Подробнее</span>
                                    <svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.495 6.49497C20.7683 6.22161 20.7683 5.77839 20.495 5.50503L16.0402 1.05025C15.7668 0.776886 15.3236 0.776886 15.0503 1.05025C14.7769 1.32362 14.7769 1.76684 15.0503 2.0402L19.01 6L15.0503 9.9598C14.7769 10.2332 14.7769 10.6764 15.0503 10.9497C15.3236 11.2231 15.7668 11.2231 16.0402 10.9497L20.495 6.49497ZM0 6.7H20V5.3H0V6.7Z"
                                              fill="currentColor" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- .slider-nav: Газоснабжение-->
                <div class="slider-nav" x-show="currentView == 'Газоснабжение'" x-cloak>
                    <div class="slider-nav__btn slider-nav__btn--prev" data-gas-slider-prev>
                        <svg class="svg-sprite-icon icon-arrow-left" width="1em" height="1em">
                            <use xlink:href="/static/images/sprite/symbol/sprite.svg#arrow-left"></use>
                        </svg>
                    </div>
                    <div class="slider-nav__btn slider-nav__btn--next" data-gas-slider-next>
                        <svg class="svg-sprite-icon icon-arrow-right" width="1em" height="1em">
                            <use xlink:href="/static/images/sprite/symbol/sprite.svg#arrow-right"></use>
                        </svg>
                    </div>
                </div>
                <!-- ._view: Водоснабжение-->
                <div class="s-specials__view swiper" x-show="currentView == 'Водоснабжение'" data-water-slider x-cloak>
                    <div class="s-specials__wrapper swiper-wrapper">
                        <!-- ._slide-->
                        <div class="s-specials__slide swiper-slide">
                            <div class="s-card">
                                <div class="s-card__badge">Акция</div>
                                <a class="s-card__preview" href="javascript:void(0)" title="Муфты Frialen UB без упора, SDR 11, SDR 17">
                                    <picture>
                                        <source srcset="/" data-srcset="/static/images/common/card-1.webp" type="image/webp" />
                                        <img class="s-card__pic lazy" src="/" data-src="/static/images/common/card-1.png" width="146" height="146" alt="" />
                                    </picture>
                                </a>
                                <a class="s-card__title" href="javascript:void(0)">Муфты Frialen UB без упора, SDR 11, SDR 17</a>
                                <!--._pricing-->
                                <!--  ._price= price + ' ₽'-->
                                <!--  ._ofcount / 1 шт-->
                                <a class="s-card__link" href="javascript:void(0)" title="Подробнее">
                                    <span>Подробнее</span>
                                    <svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.495 6.49497C20.7683 6.22161 20.7683 5.77839 20.495 5.50503L16.0402 1.05025C15.7668 0.776886 15.3236 0.776886 15.0503 1.05025C14.7769 1.32362 14.7769 1.76684 15.0503 2.0402L19.01 6L15.0503 9.9598C14.7769 10.2332 14.7769 10.6764 15.0503 10.9497C15.3236 11.2231 15.7668 11.2231 16.0402 10.9497L20.495 6.49497ZM0 6.7H20V5.3H0V6.7Z"
                                              fill="currentColor" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <!-- ._slide-->
                        <div class="s-specials__slide swiper-slide">
                            <div class="s-card">
                                <div class="s-card__badge">Акция</div>
                                <a class="s-card__preview" href="javascript:void(0)" title="Угольник латунь Дн16 RM122 пресс (200/10) Giacomini RM122Y003">
                                    <picture>
                                        <source srcset="/" data-srcset="/static/images/common/card-2.webp" type="image/webp" />
                                        <img class="s-card__pic lazy" src="/" data-src="/static/images/common/card-2.png" width="146" height="146" alt="" />
                                    </picture>
                                </a>
                                <a class="s-card__title" href="javascript:void(0)">Угольник латунь Дн16 RM122 пресс (200/10) Giacomini RM122Y003</a>
                                <!--._pricing-->
                                <!--  ._price= price + ' ₽'-->
                                <!--  ._ofcount / 1 шт-->
                                <a class="s-card__link" href="javascript:void(0)" title="Подробнее">
                                    <span>Подробнее</span>
                                    <svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.495 6.49497C20.7683 6.22161 20.7683 5.77839 20.495 5.50503L16.0402 1.05025C15.7668 0.776886 15.3236 0.776886 15.0503 1.05025C14.7769 1.32362 14.7769 1.76684 15.0503 2.0402L19.01 6L15.0503 9.9598C14.7769 10.2332 14.7769 10.6764 15.0503 10.9497C15.3236 11.2231 15.7668 11.2231 16.0402 10.9497L20.495 6.49497ZM0 6.7H20V5.3H0V6.7Z"
                                              fill="currentColor" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <!-- ._slide-->
                        <div class="s-specials__slide swiper-slide">
                            <div class="s-card">
                                <div class="s-card__badge">Акция</div>
                                <a class="s-card__preview" href="javascript:void(0)" title="Цилиндр минеральная вата 89/50 L=1м 650С желтый ROCKWOOL">
                                    <picture>
                                        <source srcset="/" data-srcset="/static/images/common/card-3.webp" type="image/webp" />
                                        <img class="s-card__pic lazy" src="/" data-src="/static/images/common/card-3.png" width="146" height="146" alt="" />
                                    </picture>
                                </a>
                                <a class="s-card__title" href="javascript:void(0)">Цилиндр минеральная вата 89/50 L=1м 650С желтый ROCKWOOL</a>
                                <!--._pricing-->
                                <!--  ._price= price + ' ₽'-->
                                <!--  ._ofcount / 1 шт-->
                                <a class="s-card__link" href="javascript:void(0)" title="Подробнее">
                                    <span>Подробнее</span>
                                    <svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.495 6.49497C20.7683 6.22161 20.7683 5.77839 20.495 5.50503L16.0402 1.05025C15.7668 0.776886 15.3236 0.776886 15.0503 1.05025C14.7769 1.32362 14.7769 1.76684 15.0503 2.0402L19.01 6L15.0503 9.9598C14.7769 10.2332 14.7769 10.6764 15.0503 10.9497C15.3236 11.2231 15.7668 11.2231 16.0402 10.9497L20.495 6.49497ZM0 6.7H20V5.3H0V6.7Z"
                                              fill="currentColor" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <!-- ._slide-->
                        <div class="s-specials__slide swiper-slide">
                            <div class="s-card">
                                <div class="s-card__badge">Акция</div>
                                <a class="s-card__preview" href="javascript:void(0)" title="Задвижка 31лс41нж сталь 09Г2С Ду50 Ру16 с КОФ ИКАР">
                                    <picture>
                                        <source srcset="/" data-srcset="/static/images/common/card-4.webp" type="image/webp" />
                                        <img class="s-card__pic lazy" src="/" data-src="/static/images/common/card-4.png" width="146" height="146" alt="" />
                                    </picture>
                                </a>
                                <a class="s-card__title" href="javascript:void(0)">Задвижка 31лс41нж сталь 09Г2С Ду50 Ру16 с КОФ ИКАР</a>
                                <!--._pricing-->
                                <!--  ._price= price + ' ₽'-->
                                <!--  ._ofcount / 1 шт-->
                                <a class="s-card__link" href="javascript:void(0)" title="Подробнее">
                                    <span>Подробнее</span>
                                    <svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.495 6.49497C20.7683 6.22161 20.7683 5.77839 20.495 5.50503L16.0402 1.05025C15.7668 0.776886 15.3236 0.776886 15.0503 1.05025C14.7769 1.32362 14.7769 1.76684 15.0503 2.0402L19.01 6L15.0503 9.9598C14.7769 10.2332 14.7769 10.6764 15.0503 10.9497C15.3236 11.2231 15.7668 11.2231 16.0402 10.9497L20.495 6.49497ZM0 6.7H20V5.3H0V6.7Z"
                                              fill="currentColor" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <!-- ._slide-->
                        <div class="s-specials__slide swiper-slide">
                            <div class="s-card">
                                <div class="s-card__badge">Акция</div>
                                <a class="s-card__preview" href="javascript:void(0)" title="Муфты Frialen UB без упора, SDR 11, SDR 17">
                                    <picture>
                                        <source srcset="/" data-srcset="/static/images/common/card-1.webp" type="image/webp" />
                                        <img class="s-card__pic lazy" src="/" data-src="/static/images/common/card-1.png" width="146" height="146" alt="" />
                                    </picture>
                                </a>
                                <a class="s-card__title" href="javascript:void(0)">Муфты Frialen UB без упора, SDR 11, SDR 17</a>
                                <!--._pricing-->
                                <!--  ._price= price + ' ₽'-->
                                <!--  ._ofcount / 1 шт-->
                                <a class="s-card__link" href="javascript:void(0)" title="Подробнее">
                                    <span>Подробнее</span>
                                    <svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.495 6.49497C20.7683 6.22161 20.7683 5.77839 20.495 5.50503L16.0402 1.05025C15.7668 0.776886 15.3236 0.776886 15.0503 1.05025C14.7769 1.32362 14.7769 1.76684 15.0503 2.0402L19.01 6L15.0503 9.9598C14.7769 10.2332 14.7769 10.6764 15.0503 10.9497C15.3236 11.2231 15.7668 11.2231 16.0402 10.9497L20.495 6.49497ZM0 6.7H20V5.3H0V6.7Z"
                                              fill="currentColor" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <!-- ._slide-->
                        <div class="s-specials__slide swiper-slide">
                            <div class="s-card">
                                <div class="s-card__badge">Акция</div>
                                <a class="s-card__preview" href="javascript:void(0)" title="Угольник латунь Дн16 RM122 пресс (200/10) Giacomini RM122Y003">
                                    <picture>
                                        <source srcset="/" data-srcset="/static/images/common/card-2.webp" type="image/webp" />
                                        <img class="s-card__pic lazy" src="/" data-src="/static/images/common/card-2.png" width="146" height="146" alt="" />
                                    </picture>
                                </a>
                                <a class="s-card__title" href="javascript:void(0)">Угольник латунь Дн16 RM122 пресс (200/10) Giacomini RM122Y003</a>
                                <!--._pricing-->
                                <!--  ._price= price + ' ₽'-->
                                <!--  ._ofcount / 1 шт-->
                                <a class="s-card__link" href="javascript:void(0)" title="Подробнее">
                                    <span>Подробнее</span>
                                    <svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.495 6.49497C20.7683 6.22161 20.7683 5.77839 20.495 5.50503L16.0402 1.05025C15.7668 0.776886 15.3236 0.776886 15.0503 1.05025C14.7769 1.32362 14.7769 1.76684 15.0503 2.0402L19.01 6L15.0503 9.9598C14.7769 10.2332 14.7769 10.6764 15.0503 10.9497C15.3236 11.2231 15.7668 11.2231 16.0402 10.9497L20.495 6.49497ZM0 6.7H20V5.3H0V6.7Z"
                                              fill="currentColor" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <!-- ._slide-->
                        <div class="s-specials__slide swiper-slide">
                            <div class="s-card">
                                <div class="s-card__badge">Акция</div>
                                <a class="s-card__preview" href="javascript:void(0)" title="Цилиндр минеральная вата 89/50 L=1м 650С желтый ROCKWOOL">
                                    <picture>
                                        <source srcset="/" data-srcset="/static/images/common/card-3.webp" type="image/webp" />
                                        <img class="s-card__pic lazy" src="/" data-src="/static/images/common/card-3.png" width="146" height="146" alt="" />
                                    </picture>
                                </a>
                                <a class="s-card__title" href="javascript:void(0)">Цилиндр минеральная вата 89/50 L=1м 650С желтый ROCKWOOL</a>
                                <!--._pricing-->
                                <!--  ._price= price + ' ₽'-->
                                <!--  ._ofcount / 1 шт-->
                                <a class="s-card__link" href="javascript:void(0)" title="Подробнее">
                                    <span>Подробнее</span>
                                    <svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.495 6.49497C20.7683 6.22161 20.7683 5.77839 20.495 5.50503L16.0402 1.05025C15.7668 0.776886 15.3236 0.776886 15.0503 1.05025C14.7769 1.32362 14.7769 1.76684 15.0503 2.0402L19.01 6L15.0503 9.9598C14.7769 10.2332 14.7769 10.6764 15.0503 10.9497C15.3236 11.2231 15.7668 11.2231 16.0402 10.9497L20.495 6.49497ZM0 6.7H20V5.3H0V6.7Z"
                                              fill="currentColor" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <!-- ._slide-->
                        <div class="s-specials__slide swiper-slide">
                            <div class="s-card">
                                <div class="s-card__badge">Акция</div>
                                <a class="s-card__preview" href="javascript:void(0)" title="Задвижка 31лс41нж сталь 09Г2С Ду50 Ру16 с КОФ ИКАР">
                                    <picture>
                                        <source srcset="/" data-srcset="/static/images/common/card-4.webp" type="image/webp" />
                                        <img class="s-card__pic lazy" src="/" data-src="/static/images/common/card-4.png" width="146" height="146" alt="" />
                                    </picture>
                                </a>
                                <a class="s-card__title" href="javascript:void(0)">Задвижка 31лс41нж сталь 09Г2С Ду50 Ру16 с КОФ ИКАР</a>
                                <!--._pricing-->
                                <!--  ._price= price + ' ₽'-->
                                <!--  ._ofcount / 1 шт-->
                                <a class="s-card__link" href="javascript:void(0)" title="Подробнее">
                                    <span>Подробнее</span>
                                    <svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.495 6.49497C20.7683 6.22161 20.7683 5.77839 20.495 5.50503L16.0402 1.05025C15.7668 0.776886 15.3236 0.776886 15.0503 1.05025C14.7769 1.32362 14.7769 1.76684 15.0503 2.0402L19.01 6L15.0503 9.9598C14.7769 10.2332 14.7769 10.6764 15.0503 10.9497C15.3236 11.2231 15.7668 11.2231 16.0402 10.9497L20.495 6.49497ZM0 6.7H20V5.3H0V6.7Z"
                                              fill="currentColor" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <!-- ._slide-->
                        <div class="s-specials__slide swiper-slide">
                            <div class="s-card">
                                <div class="s-card__badge">Акция</div>
                                <a class="s-card__preview" href="javascript:void(0)" title="Муфты Frialen UB без упора, SDR 11, SDR 17">
                                    <picture>
                                        <source srcset="/" data-srcset="/static/images/common/card-1.webp" type="image/webp" />
                                        <img class="s-card__pic lazy" src="/" data-src="/static/images/common/card-1.png" width="146" height="146" alt="" />
                                    </picture>
                                </a>
                                <a class="s-card__title" href="javascript:void(0)">Муфты Frialen UB без упора, SDR 11, SDR 17</a>
                                <!--._pricing-->
                                <!--  ._price= price + ' ₽'-->
                                <!--  ._ofcount / 1 шт-->
                                <a class="s-card__link" href="javascript:void(0)" title="Подробнее">
                                    <span>Подробнее</span>
                                    <svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.495 6.49497C20.7683 6.22161 20.7683 5.77839 20.495 5.50503L16.0402 1.05025C15.7668 0.776886 15.3236 0.776886 15.0503 1.05025C14.7769 1.32362 14.7769 1.76684 15.0503 2.0402L19.01 6L15.0503 9.9598C14.7769 10.2332 14.7769 10.6764 15.0503 10.9497C15.3236 11.2231 15.7668 11.2231 16.0402 10.9497L20.495 6.49497ZM0 6.7H20V5.3H0V6.7Z"
                                              fill="currentColor" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <!-- ._slide-->
                        <div class="s-specials__slide swiper-slide">
                            <div class="s-card">
                                <div class="s-card__badge">Акция</div>
                                <a class="s-card__preview" href="javascript:void(0)" title="Угольник латунь Дн16 RM122 пресс (200/10) Giacomini RM122Y003">
                                    <picture>
                                        <source srcset="/" data-srcset="/static/images/common/card-2.webp" type="image/webp" />
                                        <img class="s-card__pic lazy" src="/" data-src="/static/images/common/card-2.png" width="146" height="146" alt="" />
                                    </picture>
                                </a>
                                <a class="s-card__title" href="javascript:void(0)">Угольник латунь Дн16 RM122 пресс (200/10) Giacomini RM122Y003</a>
                                <!--._pricing-->
                                <!--  ._price= price + ' ₽'-->
                                <!--  ._ofcount / 1 шт-->
                                <a class="s-card__link" href="javascript:void(0)" title="Подробнее">
                                    <span>Подробнее</span>
                                    <svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.495 6.49497C20.7683 6.22161 20.7683 5.77839 20.495 5.50503L16.0402 1.05025C15.7668 0.776886 15.3236 0.776886 15.0503 1.05025C14.7769 1.32362 14.7769 1.76684 15.0503 2.0402L19.01 6L15.0503 9.9598C14.7769 10.2332 14.7769 10.6764 15.0503 10.9497C15.3236 11.2231 15.7668 11.2231 16.0402 10.9497L20.495 6.49497ZM0 6.7H20V5.3H0V6.7Z"
                                              fill="currentColor" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <!-- ._slide-->
                        <div class="s-specials__slide swiper-slide">
                            <div class="s-card">
                                <div class="s-card__badge">Акция</div>
                                <a class="s-card__preview" href="javascript:void(0)" title="Цилиндр минеральная вата 89/50 L=1м 650С желтый ROCKWOOL">
                                    <picture>
                                        <source srcset="/" data-srcset="/static/images/common/card-3.webp" type="image/webp" />
                                        <img class="s-card__pic lazy" src="/" data-src="/static/images/common/card-3.png" width="146" height="146" alt="" />
                                    </picture>
                                </a>
                                <a class="s-card__title" href="javascript:void(0)">Цилиндр минеральная вата 89/50 L=1м 650С желтый ROCKWOOL</a>
                                <!--._pricing-->
                                <!--  ._price= price + ' ₽'-->
                                <!--  ._ofcount / 1 шт-->
                                <a class="s-card__link" href="javascript:void(0)" title="Подробнее">
                                    <span>Подробнее</span>
                                    <svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.495 6.49497C20.7683 6.22161 20.7683 5.77839 20.495 5.50503L16.0402 1.05025C15.7668 0.776886 15.3236 0.776886 15.0503 1.05025C14.7769 1.32362 14.7769 1.76684 15.0503 2.0402L19.01 6L15.0503 9.9598C14.7769 10.2332 14.7769 10.6764 15.0503 10.9497C15.3236 11.2231 15.7668 11.2231 16.0402 10.9497L20.495 6.49497ZM0 6.7H20V5.3H0V6.7Z"
                                              fill="currentColor" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <!-- ._slide-->
                        <div class="s-specials__slide swiper-slide">
                            <div class="s-card">
                                <div class="s-card__badge">Акция</div>
                                <a class="s-card__preview" href="javascript:void(0)" title="Задвижка 31лс41нж сталь 09Г2С Ду50 Ру16 с КОФ ИКАР">
                                    <picture>
                                        <source srcset="/" data-srcset="/static/images/common/card-4.webp" type="image/webp" />
                                        <img class="s-card__pic lazy" src="/" data-src="/static/images/common/card-4.png" width="146" height="146" alt="" />
                                    </picture>
                                </a>
                                <a class="s-card__title" href="javascript:void(0)">Задвижка 31лс41нж сталь 09Г2С Ду50 Ру16 с КОФ ИКАР</a>
                                <!--._pricing-->
                                <!--  ._price= price + ' ₽'-->
                                <!--  ._ofcount / 1 шт-->
                                <a class="s-card__link" href="javascript:void(0)" title="Подробнее">
                                    <span>Подробнее</span>
                                    <svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.495 6.49497C20.7683 6.22161 20.7683 5.77839 20.495 5.50503L16.0402 1.05025C15.7668 0.776886 15.3236 0.776886 15.0503 1.05025C14.7769 1.32362 14.7769 1.76684 15.0503 2.0402L19.01 6L15.0503 9.9598C14.7769 10.2332 14.7769 10.6764 15.0503 10.9497C15.3236 11.2231 15.7668 11.2231 16.0402 10.9497L20.495 6.49497ZM0 6.7H20V5.3H0V6.7Z"
                                              fill="currentColor" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- .slider-nav: Водоснабжение-->
                <div class="slider-nav" x-show="currentView == 'Водоснабжение'" x-cloak>
                    <div class="slider-nav__btn slider-nav__btn--prev" data-water-slider-prev>
                        <svg class="svg-sprite-icon icon-arrow-left" width="1em" height="1em">
                            <use xlink:href="/static/images/sprite/symbol/sprite.svg#arrow-left"></use>
                        </svg>
                    </div>
                    <div class="slider-nav__btn slider-nav__btn--next" data-water-slider-next>
                        <svg class="svg-sprite-icon icon-arrow-right" width="1em" height="1em">
                            <use xlink:href="/static/images/sprite/symbol/sprite.svg#arrow-right"></use>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="s-form">
        <div class="s-form__wrapper container">
            <div class="s-form__form">
                <div class="b-form lazy" data-bg="/static/images/common/b-form-bg.png">
                    <form class="b-form__body" action="#">
                        <div class="b-form__head">
                            <div class="b-form__title">Время - деньги!</div>
                            <div class="b-form__subtitle">Менеджер Александр подскажет по ассортименту и сделает лучшее предложение</div>
                        </div>
                        <div class="b-form__content">
                            <div class="b-form__fields">
                                <input class="input-field" type="text" name="name" placeholder="Ваше имя" required>
                                <input class="input-field" type="tel" name="phone" placeholder="+7 (___) ___-__-__" required>
                            </div>
                            <div class="b-form__text">
                                <textarea class="input-field input-field--text" name="message" placeholder="Задайте Ваш вопрос" required></textarea>
                            </div>
                        </div>
                        <div class="b-form__bottom">
                            <div class="b-form__policy">
                                <label class="checkbox checkbox--popup">
                                    <input class="checkbox__input" type="checkbox" checked required>
                                    <span class="checkbox__box"></span>
                                    <span class="checkbox__policy">Даю согласие на обработку персональных данных.
												<a href="javascript:void(0)" target="_blank">Пользовательское соглашение</a>
											</span>
                                </label>
                            </div>
                            <div class="b-form__action">
                                <button class="form-submit btn-reset" type="button" name="submit" aria-label="Отправить">
                                    <span>Отправить</span>
                                    <svg width="31" height="12" viewBox="0 0 31 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M30.495 6.49497C30.7683 6.22161 30.7683 5.77839 30.495 5.50503L26.0402 1.05025C25.7668 0.776886 25.3236 0.776886 25.0503 1.05025C24.7769 1.32362 24.7769 1.76684 25.0503 2.0402L29.0101 6L25.0503 9.9598C24.7769 10.2332 24.7769 10.6764 25.0503 10.9497C25.3236 11.2231 25.7668 11.2231 26.0402 10.9497L30.495 6.49497ZM0 6.7H30V5.3H0V6.7Z"
                                              fill="white" />
                                    </svg>

                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="s-about lazy" data-bg="/static/images/common/s-about-bg.png">
        <div class="s-about__container container">
            <div class="s-about__body">
                <div class="s-about__content">
                    <div class="s-about__title">О компании</div>
                    <div class="s-about__subtitle">Крупнейший поставщик по УРФО</div>
                    <div class="s-about__text">Компания «Сантехкомплект-Урал» основана в 1995 году, как самостоятельная часть холдинга «Сантехкомплект». Уже более 27 лет «Сантехкомплект-Урал» обеспечивает комплексные поставки инженерной сантехники и является крупнейшим в УрФО логистическим
                        центром оборудования для систем тепло-, холодо-, водоснабжения и водоотведения.</div>
                    <div class="s-about__row">
                        <div class="s-about__col">
                            <div class="s-about__count">18+</div>
                            <div class="s-about__value">
                                <nobr>лет на рынке</nobr>
                            </div>
                        </div>
                        <div class="s-about__col">
                            <div class="s-about__count">260+</div>
                            <div class="s-about__value">товарных групп</div>
                        </div>
                        <div class="s-about__col">
                            <div class="s-about__count">36 000+</div>
                            <div class="s-about__value">наименований</div>
                        </div>
                    </div>
                </div>
                <picture>
                    <source srcset="/" data-srcset="/static/images/common/s-about.webp" type="image/webp">
                    <img class="s-about__pic lazy" src="" data-src="/static/images/common/s-about.png" width="571" height="612" alt="">
                </picture>
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
                            <a class="s-delivery__link" href="javascript:void(0)" title="Смотреть контакты">
                                <span>Смотреть контакты</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="31" height="12" fill="none">
                                    <path fill="currentColor" d="M30.495 6.495a.7.7 0 0 0 0-.99L26.04 1.05a.7.7 0 1 0-.99.99L29.01 6l-3.96 3.96a.7.7 0 1 0 .99.99l4.455-4.455ZM0 6.7h30V5.3H0v1.4Z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <img class="s-delivery__decor lazy" src="/" data-src="/static/images/common/delivery-decor-1.png" width="488" height="518" alt="">
                </div>
                <div class="s-delivery__body">
                    <div class="s-delivery__content">
                        <div class="s-delivery__cities">
                            <div class="s-delivery__city">
                                <svg class="svg-sprite-icon icon-marker" width="1em" height="1em">
                                    <use xlink:href="/static/images/sprite/symbol/sprite.svg#marker"></use>
                                </svg>
                                <span>Санкт-Петербург</span>
                            </div>
                            <div class="s-delivery__city">
                                <svg class="svg-sprite-icon icon-marker" width="1em" height="1em">
                                    <use xlink:href="/static/images/sprite/symbol/sprite.svg#marker"></use>
                                </svg>
                                <span>Казань</span>
                            </div>
                            <div class="s-delivery__city">
                                <svg class="svg-sprite-icon icon-marker" width="1em" height="1em">
                                    <use xlink:href="/static/images/sprite/symbol/sprite.svg#marker"></use>
                                </svg>
                                <span>Москва</span>
                            </div>
                            <div class="s-delivery__city">
                                <svg class="svg-sprite-icon icon-marker" width="1em" height="1em">
                                    <use xlink:href="/static/images/sprite/symbol/sprite.svg#marker"></use>
                                </svg>
                                <span>Сочи</span>
                            </div>
                            <div class="s-delivery__city">
                                <svg class="svg-sprite-icon icon-marker" width="1em" height="1em">
                                    <use xlink:href="/static/images/sprite/symbol/sprite.svg#marker"></use>
                                </svg>
                                <span>Нижний Новгород</span>
                            </div>
                            <div class="s-delivery__city">
                                <svg class="svg-sprite-icon icon-marker" width="1em" height="1em">
                                    <use xlink:href="/static/images/sprite/symbol/sprite.svg#marker"></use>
                                </svg>
                                <span>Калининград</span>
                            </div>
                            <div class="s-delivery__city">
                                <svg class="svg-sprite-icon icon-marker" width="1em" height="1em">
                                    <use xlink:href="/static/images/sprite/symbol/sprite.svg#marker"></use>
                                </svg>
                                <span>Владивосток</span>
                            </div>
                            <div class="s-delivery__city">
                                <svg class="svg-sprite-icon icon-marker" width="1em" height="1em">
                                    <use xlink:href="/static/images/sprite/symbol/sprite.svg#marker"></use>
                                </svg>
                                <span>Суздаль</span>
                            </div>
                            <div class="s-delivery__city">
                                <svg class="svg-sprite-icon icon-marker" width="1em" height="1em">
                                    <use xlink:href="/static/images/sprite/symbol/sprite.svg#marker"></use>
                                </svg>
                                <span>Сергиев Посад</span>
                            </div>
                            <div class="s-delivery__city">
                                <svg class="svg-sprite-icon icon-marker" width="1em" height="1em">
                                    <use xlink:href="/static/images/sprite/symbol/sprite.svg#marker"></use>
                                </svg>
                                <span>Ярославль</span>
                            </div>
                        </div>
                        <img class="s-delivery__map lazy" src="/" data-src="/static/images/common/delivery-map.svg" width="704" height="417" alt="">
                    </div>
                    <img class="s-delivery__decor s-delivery__decor--alt lazy" src="/" data-src="/static/images/common/delivery-decor-2.png" width="556" height="492" alt="">
                </div>
            </div>
        </div>
    </section>
</main>
@stop
