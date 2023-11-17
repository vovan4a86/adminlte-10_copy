<div class="mob-nav" id="mob-nav">
    <ul class="mob-nav__list">
        <li class="mob-nav__item" data-nav-highlight>
            <a class="mob-nav__link" href="{{ route('main') }}">Главная</a>
        </li>
        @if($mainSections)
            <li class="mob-nav__item">
                <a class="mob-nav__link" href="#">Каталог</a>
{{--                <span class="mob-nav__link">Каталог</span>--}}
                <ul>
                    @foreach($mainSections as $mainSection)
                        <li>
                            <a href="{{ $mainSection->url }}">{{ $mainSection->name }}</a>
                            @if($mainSection->children)
                                <ul>
                                    @foreach($mainSection->children as $child)
                                        <li>
                                            <a href="{{ $child->url }}">{{ $child->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </li>
        @endif
        @if($topMenu)
            @foreach($topMenu as $topPage)
                <li class="mob-nav__item">
                    <a class="mob-nav__link" href="{{ $topPage->url }}">{{ $topPage->name }}</a>
                    @if($topPage->alias == 'services' && count($mobServices))
                        <ul>
                            @foreach($mobServices as $ch)
                                <li>
                                    <a href="{{ $ch->url }}">{{ $ch->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        @endif
    </ul>
    <ul class="mob-nav__bottom">
        <li class="mob-nav__icon">
            <a href="tel:{{ Settings::getPhoneFromCode('footer_phone') }}">
                <span class="iconify" data-icon="carbon:phone-filled" data-width="30"></span>
            </a>
        </li>
        <li class="mob-nav__icon">
            <a href="mailto:{{ Settings::get('footer_email') }}">
                <span class="iconify" data-icon="ic:baseline-email" data-width="30"></span>
            </a>
        </li>
    </ul>
</div>
