@extends('template')
@section('content')
    @include('blocks.bread')
    <main>
        <section class="news">
            <div class="news__container container">
                <h1 class="v-hidden">{{ $title }}</h1>
                <div class="news__title">{{ $title }}</div>
                <div class="news__subtitle">{!! $text !!}</div>
                <div class="news__list">
                    @foreach($items as $item)
                        @if($item->is_action)
                            @include('news.list_item_action')
                        @else
                            @include('news.list_item')
                        @endif
                    @endforeach
                </div>
                <div class="pagination">
                    @include('paginations.with_pages', ['paginator' => $items])
                </div>
            </div>
        </section>
    </main>
@endsection
