<!-- headIsWhite && 'header--white'-->
<header class="header">
    <!-- ._top-->
    <div class="header__top">
        <div class="header__container header__container--top container">
            <div class="header__award">
                <span class="b-award" title="Официальный партнёр Hawle по УРФО">
							<span class="b-award__icon">
								<svg class="svg-sprite-icon icon-trophy">
									<use xlink:href="/static/images/sprite/symbol/sprite.svg#trophy"></use>
								</svg>
							</span>
                    <span class="b-award__label">Официальный партнёр Hawle по УРФО</span>
                </span>
            </div>
            <div class="header__menu">
                <nav class="h-menu">
                    <ul class="h-menu__list list-reset">
                        @foreach($topMenu as $item)
                            <li class="h-menu__item">
                                <a class="h-menu__link" href="{{ $item->url }}" data-link>{{ $item->name }}</a>
                            </li>
                        @endforeach
                        <li class="h-menu__item">
                            @include('blocks.header_cart')
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!-- ._body-->
    <div class="header__body">
        <div class="header__container header__container--body container">
            <div class="header__logo">
                @if(Route::is('main'))
                    <div class="logo" style='background-image: url("/static/images/common/logo.svg")'></div>
                @else
                    <a href="{{ route('main') }}" title="На главную">
                        <span class="logo lazy" data-bg="/static/images/common/logo.svg"></span>
                    </a>
                @endif
            </div>
            <div class="header__catalog">
                <!-- alpine button-catalog-->
                <button class="button-catalog btn-reset" type="button" @click="catalogIsOpen = !catalogIsOpen"
                        :class="catalogIsOpen &amp;&amp; 'is-active'"
                        aria-label="catalogIsOpen ? 'Скрыть каталог' : 'Показать каталог'">
                    <span class="button-catalog__icon iconify" x-show="!catalogIsOpen" data-icon="ci:menu-duo-lg"
                          x-cloak></span>
                    <span class="button-catalog__icon iconify" x-show="catalogIsOpen" data-icon="ic:sharp-close"
                          x-cloak></span>
                    <span class="button-catalog__label">Каталог</span>
                </button>
            </div>
            <div class="header__search">
                <form class="h-search" action="{{ route('search') }}">
                    <input class="h-search__input" type="text" name="q" placeholder="Введите название товара"
                           value="{{ Request::get('search') }}" required>
                    <button class="h-search__btn btn-reset" aria-label="Найти">
                        <svg class="svg-sprite-icon icon-search">
                            <use xlink:href="/static/images/sprite/symbol/sprite.svg#search"></use>
                        </svg>
                    </button>
                </form>
            </div>
            <div class="header__cities">
                <a class="button-cities" href="{{ route('ajax.show-popup-cities') }}"
                   data-cities data-type="ajax" title="Изменить город">
                    <svg class="svg-sprite-icon icon-pin">
                        <use xlink:href="/static/images/sprite/symbol/sprite.svg#pin"></use>
                    </svg>
                    <span class="button-cities__label">{{ $current_city ?: 'Россия' }}</span>
                </a>
            </div>
            <div class="header__infos">
                <a class="header__phone"
                   href="tel:{{ Settings::getPhoneFromCode('header_phone') }}">{{ Settings::get('header_phone') }}</a>
                <button class="button-callback btn-reset" type="button" data-src="#callback" data-popup="data-popup"
                        aria-label="Перезвоните мне">Перезвоните мне
                </button>
            </div>
        </div>
    </div>
    <!-- .o-catalog-->
    <div class="o-catalog" x-show="catalogIsOpen" @click.away="catalogIsOpen = false" x-transition.duration.250ms
         x-cloak>
        <div class="o-catalog__container container container--wide" x-data="{ catalogView: 'Газоснабжение' }">
            <div class="o-catalog__nav">
                @foreach($mainSections as $section)
                    <a class="o-catalog__tab {{ $section->isActive ? 'is-active' : '' }}" href="{{ $section->url  }}"
                       @mouseover="catalogView = '{{ $section->name }}'" :class="catalogView == '{{ $section->name }}' &amp;&amp; 'is-active'">
                        {{ $section->name }}</a>
                @endforeach
            </div>
            <div class="o-catalog__body">
                @foreach($mainSections as $section)
                    <div class="o-catalog__view" x-show="catalogView == '{{ $section->name }}'">
                        <ul class="o-catalog__list list-reset">
                            @foreach($section->children as $child)
                                <li class="o-catalog__item">
                                    <a class="o-catalog__link" href="{{ $child->url }}">{{ $child->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                        @if($catalog_action_item)
                            <div class="o-catalog__action">
                                <div class="action-catalog">
                                    <div class="action-catalog__badge">Акция</div>
                                    <div class="action-catalog__title">{{ $catalog_action_item->name }}</div>
                                    <a class="action-catalog__link" href="{{ $catalog_action_item->url }}">
                                        <span>Подробнее</span>
                                        <svg width="22" height="12" viewBox="0 0 22 12" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M20.995 6.49497C21.2683 6.22161 21.2683 5.77839 20.995 5.50503L16.5402 1.05025C16.2668 0.776886 15.8236 0.776886 15.5503 1.05025C15.2769 1.32362 15.2769 1.76684 15.5503 2.0402L19.51 6L15.5503 9.9598C15.2769 10.2332 15.2769 10.6764 15.5503 10.9497C15.8236 11.2231 16.2668 11.2231 16.5402 10.9497L20.995 6.49497ZM0.5 6.7H20.5V5.3H0.5V6.7Z"
                                                  fill="currentColor"/>
                                        </svg>
                                    </a>
                                    <img class="action-catalog__preview lazy" src="/"
                                         data-src="{{ $catalog_action_item->image ? $catalog_action_item->image->image : '' }}" width="200" height="200" alt="">
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</header>
<div class="header-mob">
    <div class="header-mob__body">
        <div class="header-mob__container container">
            <button class="header-mob__burger btn-reset" type="button" aria-label="Открыть меню">
                <span class="iconify" data-icon="charm:menu-hamburger" data-width="40"></span>
            </button>
            <div class="header-mob__logo">
                <!-- homepage ? block-->
                <div class="logo logo--mobile lazy" data-bg="/static/images/common/logo-mobile.svg"></div>
            </div>
            <div class="header-mob__actions">
                <button class="header-mob__search btn-reset" type="button" data-search-popup data-src="#search"
                        name="q" aria-label="Поиск по сайту">
                    <svg class="svg-sprite-icon icon-search">
                        <use xlink:href="/static/images/sprite/symbol/sprite.svg#search"></use>
                    </svg>
                </button>
                <div class="header-mob__basket">
                    @include('blocks.header_cart')
                </div>
                <div class="header-mob__menu" x-data="{ navIsOpen: false }">
                    <button class="header-mob__btn btn-reset" type="button" @click="navIsOpen = !navIsOpen"
                            aria-label="Показать меню">
                        <span class="iconify" data-icon="mdi:dots-vertical"></span>
                    </button>
                    <div class="header-mob__nav" x-show="navIsOpen" @click.away="navIsOpen = false"
                         x-transition.duration.500ms :class="navIsOpen &amp;&amp; 'is-active'">
                        <a class="header-mob__phone"
                           href="tel:{{ Settings::getPhoneFromCode('header_phone') }}">{{ Settings::get('header_phone') }}</a>
                        <a class="header-mob__email"
                           href="mailto:{{ Settings::get('header_email') }}">{{ Settings::get('header_email') }}</a>
                        <div class="header-mob__cities">
                            <a class="button-cities" href="{{ route('ajax.show-popup-cities') }}" data-cities
                               data-type="ajax"
                               title="Изменить город">
                                <svg class="svg-sprite-icon icon-pin">
                                    <use xlink:href="/static/images/sprite/symbol/sprite.svg#pin"></use>
                                </svg>
                                <span class="button-cities__label">{{ $current_city ?: 'Россия' }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
