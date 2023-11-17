<footer class="footer">
    <div class="footer__top">
        <div class="footer__container container">
            <div class="footer__body">
                <div class="footer__logo">
                    @if(Route::is('main'))
                        <div class="logo lazy" data-bg="/static/images/common/logo.svg"></div>
                    @else
                        <a href="{{ route('main') }}" title="На главную">
                            <span class="logo lazy" data-bg="/static/images/common/logo.svg"></span>
                        </a>
                    @endif
                </div>
                <div class="footer__navs">
                    <nav>
                        <ul class="footer__category-nav list-reset">
                            @foreach($mainSections as $section)
                            <li>
                                <a class="footer__category-link" href="{{ $section->url }}">
                                    {{ $section->name }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </nav>
                    @foreach($footerMenu as $column)
                        <nav class="footer__main-nav">
                            <ul class="footer__list list-reset">
                                @foreach($column as $page)
                                    <li>
                                        <a class="footer__link" href="{{ $page->url }}">{{ $page->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </nav>
                    @endforeach
                </div>
                <div class="footer__info">
                    <a class="footer__phone" href="tel:{{ Settings::getPhoneFromCode('footer_phone') }}">
                        {{ Settings::get('footer_phone') }}</a>
                    <div class="footer__callback">
                        <button class="button-callback btn-reset" type="button" data-src="#callback"
                                data-popup="data-popup" aria-label="Перезвоните мне">Перезвоните мне
                        </button>
                    </div>
                    <div class="footer__i-list">
                        <div class="footer__i-list__item">
                            <div class="footer__i-list__label">Прием звонков:</div>
                            <div class="footer__i-list__value">{{ Settings::get('footer_work_days') }}</div>
                        </div>
                        <div class="footer__i-list__item">
                            <div class="footer__i-list__label">Адрес склада:</div>
                            <div class="footer__i-list__value">{{ Settings::get('footer_address') }}</div>
                        </div>
                        <div class="footer__i-list__item">
                            <div class="footer__i-list__label">e-mail:</div>
                            <a class="footer__i-list__value"
                               href="mailto:{{ Settings::get('footer_email') }}">{{ Settings::get('footer_email') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer__container container">
        <div class="footer__bottom">
            <div class="footer__copyright">{{ Settings::get('footer_copy') }}</div>
            <a class="footer__policy" href="{{ route('policy') }}" target="_blank">Политика конфиденциальности</a>
        </div>
    </div>
</footer>
