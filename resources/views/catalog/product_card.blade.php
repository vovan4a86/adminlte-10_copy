<div class="subcategory__item">
    <div class="s-card">
        @if($item->is_action)
            <div class="s-card__badge">Акция</div>
        @endif
        <a class="s-card__preview" href="{{ $item->url }}" title="{{ $item->name }}">
            <picture>
                <img class="s-card__pic" src="{{ $item->showProductImage() }}"
                     data-src="{{ $item->showProductImage() }}" width="146" height="146" alt=""/>
            </picture>
        </a>
        <a class="s-card__title" href="{{ $item->url }}">{{ $item->name }}</a>
        <div class="s-card__pricing">
            <div class="s-card__price">по запросу</div>
            <div class="s-card__ofcount">/ 1 шт</div>
        </div>
    </div>
</div>
