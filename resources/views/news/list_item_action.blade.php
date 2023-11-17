<div class="news__item">
    <div class="news__card lazy" data-bg="{{ $item->thumb(3) }}">
        <div class="badge badge--white">
            <span>Акция</span>
        </div>
        <div class="news__card-title">{{ $item->name }}</div>
        <div class="news__card-discount">{{ $item->discount }}</div>
        <div class="news__card-text">{{ $item->announce }}</div>
        <div class="news__card-action">
            <a class="news__card-link" href="{{ $item->url }}" title="Подробнее">
                <span>Подробнее</span>
                <svg width="22" height="12" viewBox="0 0 22 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20.995 6.49497C21.2683 6.22161 21.2683 5.77839 20.995 5.50503L16.5402 1.05025C16.2668 0.776886 15.8236 0.776886 15.5503 1.05025C15.2769 1.32362 15.2769 1.76684 15.5503 2.0402L19.51 6L15.5503 9.9598C15.2769 10.2332 15.2769 10.6764 15.5503 10.9497C15.8236 11.2231 16.2668 11.2231 16.5402 10.9497L20.995 6.49497ZM0.5 6.7H20.5V5.3H0.5V6.7Z"
                          fill="currentColor" />
                </svg>
            </a>
        </div>
    </div>
</div>
