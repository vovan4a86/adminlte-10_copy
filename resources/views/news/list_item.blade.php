<div class="col-lg-4 col-md-6 col-sm-6">
    <div class="single-blog">
        <div class="blog-img">
            <a href="{{ $item->url }}">
                <img src="{{ $item->thumb(2) }}" alt="{{ $item->name }}">
            </a>
        </div>
        <div class="blog-content">
            <h4 class="blog-title">
                <a href="{{ $item->url }}">
                    {{ $item->name }}
                </a>
            </h4>
            <div class="blog-meta">
                <ul style="display: flex; justify-content: space-between">
                    <li><a href="#">{{ $item->dateFormat('d m, Y') }}</a></li>
                    <li><a href="#">{{ $item->news_category ? $item->category->name : 'Без категории' }}</a></li>
                </ul>
            </div>
            <div class="readmore">
                <a href="{{ $item->url }}">Читать...</a>
            </div>
        </div>
    </div>
</div>
