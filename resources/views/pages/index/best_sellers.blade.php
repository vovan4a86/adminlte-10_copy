<div class="best-seller-product pb-40">
    <div class="container">
        <div class="group-title">
            <h2>Бестселлеры</h2>
        </div>
        <div class="best-seller-pro-active  owl-carousel slider-right-content">
            @foreach($best_sellers as $i => $chunks)
                <div class="double-pro">
                    @foreach($chunks as $n => $item)
                        @include('pages.index.top_single_item')
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</div>
