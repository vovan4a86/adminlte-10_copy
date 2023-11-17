@extends('template')
@section('content')
    @include('blocks.bread')
    <main>
        <section class="category">
            <div class="category__container container">
                <div class="category__head">
                    <div class="category__title">{{ $name }}</div>
                    <h1 class="v-hidden">{{ $name }}</h1>
                    <div class="category__update">
                        <div class="badge badge--alt">
                            <span>Обновлено {{ $updatedDate }}</span>
                        </div>
                    </div>
                </div>
                <div class="subcategory__text">{{ $category->announce }}</div>
                <div class="s-categories">
                    <div class="s-categories__grid">
                        @foreach($category->children as $child)
                            <div class="s-categories__card s-categories__card--medium s-categories__card--white">
                                <a class="s-categories__subtitle" href="{{ $child->url }}">{{ $child->name }}</a>
                                <div class="s-categories__count">
                                    <div class="badge badge--alt">
                                <span>{{ $child->getRecurseProductsCount() }}
                                    {{ SiteHelper::getNumEnding($child->getRecurseProductsCount(), ['товар', 'товара', 'товаров']) }}
                                </span>
                                    </div>
                                </div>
                                <a href="{{ $child->url }}" title="{{ $child->name }}">
                                    @if($child->image)
                                        <picture>
                                            <img class="s-categories__pic lazy" src="/"
                                                 data-src="{{ \Fanky\Admin\Models\Catalog::UPLOAD_URL . $child->image }}"
                                                 width="163" height="auto" alt=""/>
                                        </picture>
                                    @endif
                                </a>
                                <a class="s-categories__sublink" href="{{ $child->url }}">
                                    <span>Подробнее</span>
                                    <svg width="21" height="12" viewBox="0 0 21 12" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.495 6.49497C20.7683 6.22161 20.7683 5.77839 20.495 5.50503L16.0402 1.05025C15.7668 0.776886 15.3236 0.776886 15.0503 1.05025C14.7769 1.32362 14.7769 1.76684 15.0503 2.0402L19.01 6L15.0503 9.9598C14.7769 10.2332 14.7769 10.6764 15.0503 10.9497C15.3236 11.2231 15.7668 11.2231 16.0402 10.9497L20.495 6.49497ZM0 6.7H20V5.3H0V6.7Z"
                                              fill="currentColor"/>
                                    </svg>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="subcategory__container container container--wide">
                    <div class="subcategory__text-block">
                        <div class="subcategory__container container text-block">
                            {!! $category->text  !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
