<div class="new-products pb-60">
    <div class="container">
        <div class="row">
            @if(count($top_products))
                <div class="col-xl-3 col-lg-4 order-2">
                    <div class="side-product-list">
                        <div class="group-title">
                            <h2>Лучшие товары</h2>
                        </div>
                        <div class="slider-right-content side-product-list-active owl-carousel">
                            @foreach($top_products as $i => $chunks)
                                <div class="double-pro">
                                    @foreach($chunks as $item)
                                        @include('pages.index.top_single_item')
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-xl-9 col-lg-8  order-lg-2">
                <div class="new-pro-content">
                    <div class="pro-tab-title border-line">
                        <ul class="nav product-list product-tab-list">
                            <li><a class="active" data-toggle="tab" href="#new-arrival">Новое поступление</a></li>
                            <li><a data-toggle="tab" href="#featured">Избранные</a></li>
                            <li><a data-toggle="tab" href="#toprated">Высокий рейтинг</a></li>
                        </ul>
                    </div>
                    <div class="tab-content product-tab-content jump">
                        <div id="new-arrival" class="tab-pane active">
                            <div class="new-pro-active owl-carousel">
                                @foreach($new_products as $item)
                                    @include('catalog.single_product')
                                @endforeach
                            </div>
                        </div>

                        <div id="featured" class="tab-pane">
                            <div class="new-pro-active owl-carousel">
                                @foreach($featured_products as $item)
                                    @include('catalog.single_product')
                                @endforeach
                            </div>
                        </div>

                        <div id="toprated" class="tab-pane">
                            <div class="new-pro-active owl-carousel">
                                @foreach($top_rated_products as $item)
                                    @include('catalog.single_product')
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="single-banner zoom mt-30 mt-sm-10">
                        <a href="#"><img src="/img/banner/tab-banner.jpg" alt="slider-banner"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
