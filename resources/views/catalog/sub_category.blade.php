@extends('template')
@section('content')
    @include('blocks.bread')
    <main>
        <section class="subcategory">
            <div class="subcategory__head">
                <div class="subcategory__container container">
                    <div class="subcategory__row">
                        <picture>
                            <img class="subcategory__pic lazy" src="/" data-src="{{ $category->image_src ?? '' }}"
                                 width="484" height="300" alt="">
                        </picture>
                        <div class="subcategory__body">
                            <div class="subcategory__title">{{ $category->name }}</div>
                            <h1 class="v-hidden">{{ $category->name }}</h1>
                            <div class="subcategory__text">{{ $category->announce }}</div>
                            @if($download_catalog)
                                <a class="subcategory__download download-link" href="{{ $download_catalog }}"
                                   download="Каталог {{ $category->name }}" title="Скачать каталог ({{$file_cat_ext}})">
                                    <svg class="svg-sprite-icon icon-download">
                                        <use xlink:href="/static/images/sprite/symbol/sprite.svg#download"></use>
                                    </svg>
                                    <span>Скачать каталог ({{ $file_cat_ext }})</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="subcategory__container container container--wide">
                <div class="subcategory__content">
                    <div class="subcategory__container container">
                        <div class="subcategory__list">
                            @each('catalog.product_card', $items, 'item')
                        </div>
                        <div class="pagination">
                            @include('paginations.with_pages', ['paginator' => $items])
                        </div>
                        <div class="subcategory__specials">
                            @include('catalog.blocks.product_actions')
                        </div>
                    </div>
                </div>
                <div class="subcategory__text-block">
                    <div class="subcategory__container container text-block">
                        {!! $category->text  !!}
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
