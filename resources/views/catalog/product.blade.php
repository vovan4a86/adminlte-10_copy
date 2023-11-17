@extends('template')
@section('content')
    @include('blocks.bread')
    <main>
        <section class="product">
            <div class="product__top">
                <div class="product__container container">
                    <div class="product__grid">
                        <div class="product__preview">
                            <a href="{{ $images[0] ? $images[0]->image : '' }}" data-fancybox title="{{ $product->name }}">
                                <picture>
                                    <img class="product__pic" src="{{ $images[0] ? $images[0]->image : '' }}"
                                         width="390" height="320" alt="{{ $product->name }}">
                                </picture>
                            </a>
                        </div>
                        <div class="product__info">
                            <div class="product__title">{{ $product->name }}</div>
                            @if(count($chars))
                                <div class="product__params" x-data="{ showMore: false }">
                                    <div class="product__params-label">Характеристики</div>
                                    <div class="product__params-data">
                                        @foreach($chars as $char)
                                            <dl class="data-list" {{ $loop->iteration > 5 ? "x-show=showMore x-transition.duration.250ms x-cloak" : '' }}>
                                                <dt class="data-list__key">
                                                    <span>{{ $char->name }}</span>
                                                </dt>
                                                <dd class="data-list__value">{{ $char->value }}</dd>
                                            </dl>
                                        @endforeach
                                    </div>
                                    @if(count($chars) > 5)
                                        <button class="product__params-show btn-reset" x-show="!showMore"
                                                @click="showMore = !showMore" x-cloak
                                                aria-label="Смотреть все характеристики">
                                            <span>Смотреть все характеристики</span>
                                            <svg width="31" height="12" viewBox="0 0 31 12" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M30.495 6.49497C30.7683 6.22161 30.7683 5.77839 30.495 5.50503L26.0402 1.05025C25.7668 0.776886 25.3236 0.776886 25.0503 1.05025C24.7769 1.32362 24.7769 1.76684 25.0503 2.0402L29.0101 6L25.0503 9.9598C24.7769 10.2332 24.7769 10.6764 25.0503 10.9497C25.3236 11.2231 25.7668 11.2231 26.0402 10.9497L30.495 6.49497ZM0 6.7H30V5.3H0V6.7Z"
                                                      fill="currentColor"/>
                                            </svg>

                                        </button>
                                        <button class="product__params-show btn-reset" x-show="showMore"
                                                @click="showMore = !showMore" x-cloak
                                                aria-label="Скрыть характеристики">
                                            <span>Скрыть характеристики</span>
                                            <svg width="31" height="12" viewBox="0 0 31 12" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M30.495 6.49497C30.7683 6.22161 30.7683 5.77839 30.495 5.50503L26.0402 1.05025C25.7668 0.776886 25.3236 0.776886 25.0503 1.05025C24.7769 1.32362 24.7769 1.76684 25.0503 2.0402L29.0101 6L25.0503 9.9598C24.7769 10.2332 24.7769 10.6764 25.0503 10.9497C25.3236 11.2231 25.7668 11.2231 26.0402 10.9497L30.495 6.49497ZM0 6.7H30V5.3H0V6.7Z"
                                                      fill="currentColor"/>
                                            </svg>

                                        </button>
                                    @endif
                                </div>
                            @endif
                            <div class="product__action">
                                @include('catalog.product_add_to_cart_btn')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end ._top-->
            <div class="product__container container container--wide">
                <div class="product__body">
                    <div class="product__container container" x-data="{ currentView: 'Текстовое описание' }">
                        <!-- ._tabs-->
                        <div class="product__tabs">
                            <div class="product__tab" @click="currentView = 'Текстовое описание'"
                                 :class="currentView == 'Текстовое описание' &amp;&amp; 'is-active'">Текстовое описание
                            </div>
                            <div class="product__tab" @click="currentView = 'Характеристики'"
                                 :class="currentView == 'Характеристики' &amp;&amp; 'is-active'">Характеристики
                            </div>
                            <div class="product__tab" @click="currentView = 'Документы'"
                                 :class="currentView == 'Документы' &amp;&amp; 'is-active'">Документы
                            </div>
                            <div class="product__tab" @click="currentView = 'Доставка'"
                                 :class="currentView == 'Доставка' &amp;&amp; 'is-active'">Доставка
                            </div>
                        </div>
                        <!-- ._views-->
                        <div class="product__views">
                            <!-- view: Текстовое описание-->
                            <div class="product__view" x-show="currentView == 'Текстовое описание'">
                                <div class="text-block">
                                    <h1>{{ $h1 }}</h1>
                                    {!!  $text  !!}
                                </div>
                            </div>
                            <!-- view: Характеристики-->
                            <div class="product__view" x-show="currentView == 'Характеристики'" x-cloak>
                                <div class="product__view-grid">
                                    @foreach($chars as $char)
                                        <dl class="data-list data-list--grey">
                                            <dt class="data-list__key">
                                                <span>{{ $char->name }}</span>
                                            </dt>
                                            <dd class="data-list__value">{{ $char->value }}</dd>
                                        </dl>
                                    @endforeach
                                </div>
                            </div>
                            <!-- view: Документы-->
                            <div class="product__view" x-show="currentView == 'Документы'" x-cloak>
                                <div class="product__view-list">
                                    @foreach($product->docs as $doc)
                                        <a class="download" href="{{ $doc->file }}" dowload="{{ $doc->name }}"
                                           title="{{ $doc->name }}">
                                            <svg class="svg-sprite-icon icon-download">
                                                <use xlink:href="/static/images/sprite/symbol/sprite.svg#download"></use>
                                            </svg>
                                            <span>{{ $doc->name }}</span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                            <!-- view: Доставка-->
                            <div class="product__view" x-show="currentView == 'Доставка'" x-cloak>
                                <div class="text-block">
                                    {!! Settings::get('product_delivery') !!}
                                </div>
                            </div>
                        </div>
                        @include('catalog.blocks.product_actions')
                    </div>
                </div>
            </div>
            <!-- end ._body-->
        </section>
    </main>
@endsection
