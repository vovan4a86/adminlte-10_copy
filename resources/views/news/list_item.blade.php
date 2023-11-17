<div class="news__item">
    <div class="news-card">
        <a href="{{ $item->url }}" title="{{ $item->title }}">
            <picture>
                <img class="news-card__pic lazy" src="/" data-src="{{ $item->thumb(2) }}" width="380" height="260" alt="" />
            </picture>
        </a>
        <a href="{{ $item->url }}" title="{{ $item->name }}">
            <span class="news-card__title">{{ $item->name }}</span>
        </a>
        <div class="news-card__text">{{ $item->announce }}</div>
        <time class="news-card__date" datetime="{{ $item->dateFormat('Y-m-d') }}">{{ $item->dateFormat() }}</time>
    </div>
</div>
