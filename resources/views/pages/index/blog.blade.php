@if(count($news))
    <div class="blog-area pb-60">
        <div class="container">
            <div class="group-title">
                <h2>Из новостей</h2>
            </div>
            <div class="blog-active owl-carousel">
                @foreach($news as $article)
                    <div class="single-blog">
                    <div class="blog-img">
                        <a href="{{ $article->url }}"><img src="{{ $article->thumb(2) }}" alt="{{ $article->name }}"></a>
                    </div>
                    <div class="blog-content">
                        <h4 class="blog-title"><a href="{{ $article->url }}">{{ $article->announce }}</a></h4>
                        <div class="blog-meta">
                            <ul>
                                <li><a href="#">{{ $article->dateFormat('d m, Y') }}</a></li>
                            </ul>
                        </div>
                        <div class="readmore">
                            <a href="{{ $article->url }}">Читать...</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
