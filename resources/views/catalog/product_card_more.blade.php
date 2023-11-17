<div class="s-card">
    @if($item->is_action)
        <div class="s-card__badge">Акция</div>
    @endif
    <a class="s-card__preview" href="{{ $item->url }}"
       title="Муфты Frialen UB без упора, SDR 11, SDR 17">
        <picture>
            <img class="s-card__pic lazy" src="/"
                 data-src="{{ $item->showProductImage() }}"
                 width="146" height="146" alt=""/>
        </picture>
    </a>
    <a class="s-card__title" href="{{ $item->url }}">{{ $item->name }}</a>
    <a class="s-card__link" href="{{ $item->url }}" title="Подробнее">
        <span>Подробнее</span>
        <svg width="21" height="12" viewBox="0 0 21 12" fill="none"
             xmlns="http://www.w3.org/2000/svg">
            <path d="M20.495 6.49497C20.7683 6.22161 20.7683 5.77839 20.495 5.50503L16.0402 1.05025C15.7668 0.776886 15.3236 0.776886 15.0503 1.05025C14.7769 1.32362 14.7769 1.76684 15.0503 2.0402L19.01 6L15.0503 9.9598C14.7769 10.2332 14.7769 10.6764 15.0503 10.9497C15.3236 11.2231 15.7668 11.2231 16.0402 10.9497L20.495 6.49497ZM0 6.7H20V5.3H0V6.7Z"
                  fill="currentColor"/>
        </svg>
    </a>
</div>
