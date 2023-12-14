@extends('template')
@section('content')
    @include('blocks.bread')

    <div class="blog-page pb-60">
        <div class="container">
            <div class="category-items">
                <div class="cat-elem">
                    <a href="{{ route('news') }}"
                       class="{{ !isset($cat) ? 'active' : null }}">
                        Все
                    </a>
                </div>
                <div class="cat-elem">
                    <a href="{{ route('news', ['cat' => 0]) }}"
                       class="{{ isset($cat) && $cat == 0 ? 'active' : null }}">
                        Без категории
                    </a>
                </div>
                @foreach($news_categories as $category)
                    <div class="cat-elem">
                        <a href="{{ route('news', ['cat' => $category->id]) }}"
                           class="{{ isset($cat) && $cat == $category->id ? 'active' : null }}">
                            {{ $category->name }}
                        </a>
                    </div>
                @endforeach
            </div>
            @if(count($news))
                <div class="row">
                    @foreach($news as $item)
                        @include('news.list_item')
                    @endforeach
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        @include('pagination.news', ['paginator' => $news])
                    </div>
                </div>
            @else
                <h4>Нет новостей</h4>
            @endif
        </div>
    </div>

    @include('blocks.brands')

@endsection
