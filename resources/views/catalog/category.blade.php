@extends('template')
@section('content')
    @include('blocks.bread')
    <div class="main-shop-page pb-60">
        <div class="container">
            <div class="row">
                <!-- Sidebar Shopping Option Start -->
                <div class="col-lg-3  order-2">
                    <div class="sidebar white-bg">
                        <div class="single-sidebar">
                            <div class="group-title">
                                <h2>Категории</h2>
                            </div>
                            <ul>
                                @foreach($categories as $category)
                                    <li>
                                        <a href="{{ $category->url }}" class="category-link {{ $category->isActive ? 'active' : null }}">
                                            {{ $category->name }} ({{ $category->getRecurseProductsCount() }})
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="single-sidebar">
                            <div class="group-title">
                                <h2>color</h2>
                            </div>
                            <ul class="color-option">
                                <li>
                                    <a class="blue" href="#"></a>
                                </li>
                                <li>
                                    <a class="green" href="#"></a>
                                </li>
                                <li>
                                    <a class="black" href="#"></a>
                                </li>
                                <li>
                                    <a class="rose" href="#"></a>
                                </li>
                                <li>
                                    <a class="red" href="#"></a>
                                </li>
                                <li>
                                    <a class="purple" href="#"></a>
                                </li>
                                <li>
                                    <a class="rose" href="#"></a>
                                </li>
                                <li>
                                    <a class="yellow" href="#"></a>
                                </li>
                                <li>
                                    <a class="orange" href="#"></a>
                                </li>
                            </ul>
                        </div>
                        <div class="single-sidebar">
                            <div class="group-title">
                                <h2>price</h2>
                            </div>
                            <form action="#">
                                <div id="slider-range" class="ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content">
                                    <div class="ui-slider-range ui-corner-all ui-widget-header" ></div>
                                </div>
                                <input id="amount" class="amount" readonly="" type="text">
                            </form>
                        </div>
                        <div class="single-sidebar">
                            <div class="group-title">
                                <h2>manufacturer</h2>
                            </div>
                            <ul class="manufactures-list">
                                <li><a href="#">Brand one (14)</a></li>
                                <li><a href="#">Brand two (13)</a></li>
                                <li><a href="#">Brand three (13)</a></li>
                                <li><a href="#">Brand four (14)</a></li>
                                <li><a href="#">Brand five (13)</a></li>
                            </ul>
                        </div>
                        <div class="single-sidebar">
                            <div class="group-title">
                                <h2>Compare Products</h2>
                            </div>
                            <div class="best-seller-pro-two compare-pro best-seller-pro-two owl-carousel">
                                <!-- Best Seller Multi Product Start -->
                                <div class="best-seller-multi-product">
                                    <!-- Single Product Start -->
                                    <div class="single-product">
                                        <!-- Product Image Start -->
                                        <div class="pro-img">
                                            <a href="product.html">
                                                <img class="primary-img" src="/img/products/1.jpg" alt="single-product">
                                            </a>
                                        </div>
                                        <!-- Product Image End -->
                                        <!-- Product Content Start -->
                                        <div class="pro-content">
                                            <h4><a href="product.html">Products Name Here</a></h4>
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                            <p><span class="price">$38.00</span><del class="prev-price">$40.00</del></p>
                                        </div>
                                        <!-- Product Content End -->
                                    </div>
                                    <!-- Single Product End -->
                                </div>
                                <!-- Best Seller Multi Product End -->
                                <!-- Best Seller Multi Product Start -->
                                <div class="best-seller-multi-product">
                                    <!-- Single Product Start -->
                                    <div class="single-product">
                                        <!-- Product Image Start -->
                                        <div class="pro-img">
                                            <a href="product.html">
                                                <img class="primary-img" src="/img/products/2.jpg" alt="single-product">
                                            </a>
                                        </div>
                                        <!-- Product Image End -->
                                        <!-- Product Content Start -->
                                        <div class="pro-content">
                                            <h4><a href="product.html">Products Name Here</a></h4>
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                            <p><span class="price">$32.00</span></p>
                                        </div>
                                        <!-- Product Content End -->
                                    </div>
                                    <!-- Single Product End -->
                                </div>
                                <!-- Best Seller Multi Product End -->
                                <!-- Best Seller Multi Product Start -->
                                <div class="best-seller-multi-product">
                                    <!-- Single Product Start -->
                                    <div class="single-product">
                                        <!-- Product Image Start -->
                                        <div class="pro-img">
                                            <a href="product.html">
                                                <img class="primary-img" src="/img/products/3.jpg" alt="single-product">
                                            </a>
                                        </div>
                                        <!-- Product Image End -->
                                        <!-- Product Content Start -->
                                        <div class="pro-content">
                                            <h4><a href="product.html">Products Name Here</a></h4>
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                            <p><span class="price">$35.00</span><del class="prev-price">39.00</del></p>
                                        </div>
                                        <!-- Product Content End -->
                                    </div>
                                    <!-- Single Product End -->
                                </div>
                                <!-- Best Seller Multi Product End -->
                            </div>
                        </div>
                        <div class="single-sidebar">
                            <div class="group-title">
                                <h2>My Wish List</h2>
                            </div>
                            <div class="best-seller-pro-two compare-pro best-seller-pro-two owl-carousel">
                                <!-- Best Seller Multi Product Start -->
                                <div class="best-seller-multi-product">
                                    <!-- Single Product Start -->
                                    <div class="single-product">
                                        <!-- Product Image Start -->
                                        <div class="pro-img">
                                            <a href="product.html">
                                                <img class="primary-img" src="/img/products/4.jpg" alt="single-product">
                                            </a>
                                        </div>
                                        <!-- Product Image End -->
                                        <!-- Product Content Start -->
                                        <div class="pro-content">
                                            <h4><a href="product.html">Products Name Here</a></h4>
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                            <p><span class="price">$86.00</span><del class="prev-price">90.00</del></p>
                                        </div>
                                        <!-- Product Content End -->
                                    </div>
                                    <!-- Single Product End -->
                                </div>
                                <!-- Best Seller Multi Product End -->
                                <!-- Best Seller Multi Product Start -->
                                <div class="best-seller-multi-product">
                                    <!-- Single Product Start -->
                                    <div class="single-product">
                                        <!-- Product Image Start -->
                                        <div class="pro-img">
                                            <a href="product.html">
                                                <img class="primary-img" src="/img/products/1.jpg" alt="single-product">
                                            </a>
                                        </div>
                                        <!-- Product Image End -->
                                        <!-- Product Content Start -->
                                        <div class="pro-content">
                                            <h4><a href="product.html">Products Name Here</a></h4>
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                            <p><span class="price">$32.00</span></p>
                                        </div>
                                        <!-- Product Content End -->
                                    </div>
                                    <!-- Single Product End -->
                                </div>
                                <!-- Best Seller Multi Product End -->
                                <!-- Best Seller Multi Product Start -->
                                <div class="best-seller-multi-product">
                                    <!-- Single Product Start -->
                                    <div class="single-product">
                                        <!-- Product Image Start -->
                                        <div class="pro-img">
                                            <a href="product.html">
                                                <img class="primary-img" src="/img/products/2.jpg" alt="single-product">
                                            </a>
                                        </div>
                                        <!-- Product Image End -->
                                        <!-- Product Content Start -->
                                        <div class="pro-content">
                                            <h4><a href="product.html">Products Name Here</a></h4>
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                            <p><span class="price">$38.00</span><del class="prev-price">45.00</del></p>
                                        </div>
                                        <!-- Product Content End -->
                                    </div>
                                    <!-- Single Product End -->
                                </div>
                                <!-- Best Seller Multi Product End -->
                            </div>
                        </div>
                        <div class="single-sidebar single-banner zoom pt-20">
                            <a href="#" class="hidden-sm"><img src="/img/banner/8.jpg" alt="slider-banner"></a>
                            <a href="#" class="visible-sm"><img src="/img/banner/6.jpg" alt="slider-banner"></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 order-lg-2">
                    @if(count($category->public_children))
                        <div class="category-items">
                            @foreach($category->public_children as $sub)
                                <div class="cat-elem">
                                    <a href="{{ $sub->url }}">{{ $sub->name }} ({{ $sub->getRecurseProductsCount() }})</a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <div class="grid-list-top border-default universal-padding fix mb-30">
                        <div class="grid-list-view f-left">
                            <ul class="list-inline nav">
                                <li><a data-toggle="tab" href="#grid-view"><i class="fa fa-th"></i></a></li>
                                <li><a  class="active" data-toggle="tab" href="#list-view"><i class="fa fa-list-ul"></i></a></li>
                                <li>
                                    <span class="grid-item-list">
                                        Товары {{ $page_n < 2 ? '1' : $per_page * ($page_n - 1) }} - {{ $page_n < 2 ? $per_page : $page_n * $per_page  }} из {{ $count }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <div class="main-toolbar-sorter f-right">
                            <div class="toolbar-sorter">
                                <label>sort by</label>
                                <select class="sorter" name="sorter">
                                    <option value="Position" selected="selected">position</option>
                                    <option value="Product Name">Product Name</option>
                                    <option value="Price">Price</option>
                                </select>
                                <span><a href="#"><i class="fa fa-arrow-up"></i></a></span>
                            </div>
                        </div>
                    </div>
                    <div class="main-categorie">
                        <div class="tab-content fix">
                            <div id="grid-view" class="tab-pane ">
                                <div class="row">
                                    @foreach($items as $item)
                                        <div class="col-lg-4 col-sm-6">
                                            @include('pages.index.single_product')
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div id="list-view" class="tab-pane active">
                                @foreach($items as $item)
                                    @include('pages.index.single_product_list')
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="pagination-box fix">
                       @include('pagination.default', ['paginator' => $items])
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="brand-area pb-60">
        <div class="container">
            <!-- Brand Banner Start -->
            <div class="brand-banner owl-carousel">
                <div class="single-brand">
                    <a href="#"><img class="img" src="/img/brand/1.png" alt="brand-image"></a>
                </div>
                <div class="single-brand">
                    <a href="#"><img src="/img/brand/2.png" alt="brand-image"></a>
                </div>
                <div class="single-brand">
                    <a href="#"><img src="/img/brand/3.png" alt="brand-image"></a>
                </div>
                <div class="single-brand">
                    <a href="#"><img src="/img/brand/4.png" alt="brand-image"></a>
                </div>
                <div class="single-brand">
                    <a href="#"><img src="/img/brand/5.png" alt="brand-image"></a>
                </div>
                <div class="single-brand">
                    <a href="#"><img class="img" src="/img/brand/1.png" alt="brand-image"></a>
                </div>
                <div class="single-brand">
                    <a href="#"><img src="/img/brand/2.png" alt="brand-image"></a>
                </div>
                <div class="single-brand">
                    <a href="#"><img src="/img/brand/3.png" alt="brand-image"></a>
                </div>
                <div class="single-brand">
                    <a href="#"><img src="/img/brand/4.png" alt="brand-image"></a>
                </div>
                <div class="single-brand">
                    <a href="#"><img src="/img/brand/5.png" alt="brand-image"></a>
                </div>
            </div>
            <!-- Brand Banner End -->
        </div>
    </div>
@endsection
