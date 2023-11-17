@if(count($popularCats))
    <section class="s-categories">
        <div class="s-categories__wrapper container container--wide">
            <div class="s-categories__container container">
                <div class="s-categories__title">Популярные категории</div>
                <div class="s-categories__grid">
                    @foreach($popularCats as $group)
                        @foreach($group as $elem)
                            <div class="s-categories__card {{ $popularCatsStyles[$loop->index] }}">
                                <a class="s-categories__subtitle" href="{{ $elem->url }}">
                                    {{ $elem->name }}
                                </a>
                                <a href="{{ $elem->url }}" title="{{ $elem->name }}">
                                    <picture>
                                        <img class="s-categories__pic lazy" src="/"
                                             data-src="{{ $elem->urlImage }}"
                                             width="234" height="210" alt=""/>
                                    </picture>
                                </a>
                                <a class="s-categories__sublink" href="{{ $elem->url }}">
                                    <span>Подробнее</span>
                                    <svg width="21" height="12" viewBox="0 0 21 12" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.495 6.49497C20.7683 6.22161 20.7683 5.77839 20.495 5.50503L16.0402 1.05025C15.7668 0.776886 15.3236 0.776886 15.0503 1.05025C14.7769 1.32362 14.7769 1.76684 15.0503 2.0402L19.01 6L15.0503 9.9598C14.7769 10.2332 14.7769 10.6764 15.0503 10.9497C15.3236 11.2231 15.7668 11.2231 16.0402 10.9497L20.495 6.49497ZM0 6.7H20V5.3H0V6.7Z"
                                              fill="currentColor"/>
                                    </svg>
                                </a>
                            </div>
                        @endforeach
                    @endforeach
                </div>
                <div class="s-categories__action">
                    <a class="s-categories__link" href="{{ route('gazosnabgenie.index') }}" title="Газоснабжение">
                        <span>Газоснабжение</span>
                        <svg width="31" height="12" viewBox="0 0 31 12" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M30.495 6.49497C30.7683 6.22161 30.7683 5.77839 30.495 5.50503L26.0402 1.05025C25.7668 0.776886 25.3236 0.776886 25.0503 1.05025C24.7769 1.32362 24.7769 1.76684 25.0503 2.0402L29.0101 6L25.0503 9.9598C24.7769 10.2332 24.7769 10.6764 25.0503 10.9497C25.3236 11.2231 25.7668 11.2231 26.0402 10.9497L30.495 6.49497ZM0 6.7H30V5.3H0V6.7Z"
                                  fill="currentColor"/>
                        </svg>
                    </a>
                    <a class="s-categories__link" href="{{ route('vodosnabgenie.index') }}" title="Водоснабжение">
                        <span>Водоснабжение</span>
                        <svg width="31" height="12" viewBox="0 0 31 12" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M30.495 6.49497C30.7683 6.22161 30.7683 5.77839 30.495 5.50503L26.0402 1.05025C25.7668 0.776886 25.3236 0.776886 25.0503 1.05025C24.7769 1.32362 24.7769 1.76684 25.0503 2.0402L29.0101 6L25.0503 9.9598C24.7769 10.2332 24.7769 10.6764 25.0503 10.9497C25.3236 11.2231 25.7668 11.2231 26.0402 10.9497L30.495 6.49497ZM0 6.7H30V5.3H0V6.7Z"
                                  fill="currentColor"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endif
