<header>
    <!-- Header Top Start -->
    <div class="header-top">
        <div class="container">
            <div class="row">
                <!-- Header Top left Start -->
                <div class="col-lg-4 col-md-12 d-center">
                    <div class="header-top-left">
                        <img src="/img/icon/call.png" alt="">Позвоните нам : +7 909 123 9090
                    </div>
                </div>
                <!-- Header Top left End -->
                <!-- Search Box Start -->
                <div class="col-lg-4 col-md-6 ml-auto mr-auto">
                    <div class="search-box-view">
                        <form action="#">
                            <input type="text" class="email" placeholder="Поиск товара" name="product">
                            <button type="submit" class="submit"></button>
                        </form>
                    </div>
                </div>
                <!-- Search Box End -->
                <!-- Header Top Right Start -->
                <div class="col-lg-4 col-md-12">
                    <div class="header-top-right">
                        <ul class="header-list-menu f-right">
                            <!-- Language Start -->
                            <li><a href="#">Город: Не выбран <i class="fa fa-angle-down"></i></a>
                                <ul class="ht-dropdown">
                                    <li><a href="#">Москва</a></li>
                                    <li><a href="#">Пермь</a></li>
                                    <li><a href="#">Екатеринбург</a></li>
                                </ul>
                            </li>
                            <!-- Language End -->
                            <!-- Currency Start -->
                            <li><a href="#">Язык: RU <i class="fa fa-angle-down"></i></a>
                                <ul class="ht-dropdown">
                                    <li><a href="#">ENG</a></li>
                                </ul>
                            </li>
                            <!-- Currency End -->
                        </ul>
                        <!-- Header-list-menu End -->
                    </div>
                </div>
                <!-- Header Top Right End -->
            </div>
        </div>
        <!-- Container End -->
    </div>
    <!-- Header Top End -->
    <!-- Header Bottom Start -->
    <div class="header-bottom header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-2 col-sm-5 col-5">
                    <div class="logo">
                        <a href="index.html"><img src="/img/logo/logo.png" alt="logo-image"></a>
                    </div>
                </div>

                @if(count($topMenu))
                    <div class="col-xl-6 col-lg-7 d-none d-lg-block">
                        <div class="middle-menu pull-right">
                            <nav>
                                <ul class="middle-menu-list">
                                    @foreach($topMenu as $item)
                                        @if($item->alias !== 'catalog')
                                            <li>
                                                <a href="{{ $item->url }}">{{ $item->name }}
                                                    @if(count($item->public_children))
                                                        <i class="fa fa-angle-down"></i>
                                                    @endif
                                                </a>
                                                @if(count($item->public_children))
                                                    <ul class="ht-dropdown home-dropdown">
                                                        @foreach($item->public_children as $child)
                                                            <li><a href="{{ $child->url }}">{{ $child->name }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @else
                                            <li><a href="{{ $item->url }}">{{ $item->name }}<i
                                                        class="fa fa-angle-down"></i></a>
                                                @if(count($topCatalog))
                                                    <ul class="ht-dropdown dropdown-style-two">
                                                        @foreach($topCatalog as $catItem)
                                                            <li><a href="{{ $catItem->url }}">{{ $catItem->name }}</a>
                                                                @if(count($catItem->children))
                                                                    <ul class="ht-dropdown dropdown-style-two sub-menu">
                                                                        @foreach($catItem->children as $child)
                                                                            <li>
                                                                                <a href="{{ $child->url }}">{{ $child->name }}</a>
                                                                                @if(count($child->children))
                                                                                    <ul class="ht-dropdown dropdown-style-two sub-menu">
                                                                                        @foreach($child->children as $grandchild)
                                                                                            <li>
                                                                                                <a href="{{ $grandchild->url }}">{{ $grandchild->name }}</a>
                                                                                            </li>
                                                                                        @endforeach
                                                                                    </ul>
                                                                                @endif
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </nav>
                        </div>
                    </div>
                @endif
                <!-- Search Box End -->
                <!-- Cartt Box Start -->
                <div class="col-lg-3 col-sm-7 col-7">
                    <div class="cart-box text-right">
                        <ul>
                            @include('blocks.header_compare')
                            @include('blocks.header_favorites')
                            @include('blocks.header_cart')
                        </ul>
                    </div>
                </div>
                <!-- Cartt Box End -->
                <div class="col-sm-12 d-lg-none">
                    <div class="mobile-menu">
                        <nav>
                            <ul>
                                <li><a href="index.html">home</a>
                                    <!-- Home Version Dropdown Start -->
                                    <ul>
                                        <li><a href="index.html">Home Version One</a></li>
                                        <li><a href="index-2.html">Home Version Two</a></li>
                                        <li><a href="index-3.html">Home Box Layout</a></li>
                                    </ul>
                                    <!-- Home Version Dropdown End -->
                                </li>
                                <li><a href="shop.html">shop</a>
                                    <!-- Mobile Menu Dropdown Start -->
                                    <ul>
                                        <li><a href="product.html">Shop</a>
                                            <ul>
                                                <li><a href="shop.html">Product Category Name</a>
                                                    <!-- Start Three Step -->
                                                    <ul>
                                                        <li><a href="shop.html">Product Category Name</a></li>
                                                        <li><a href="shop.html">Product Category Name</a></li>
                                                        <li><a href="shop.html">Product Category Name</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="shop.html">Product Category Name</a></li>
                                                <li><a href="shop.html">Product Category Name</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="product.html">product details Page</a></li>
                                        <li><a href="compare.html">Compare Page</a></li>
                                        <li><a href="cart.html">Cart Page</a></li>
                                        <li><a href="checkout.html">Checkout Page</a></li>
                                        <li><a href="wishlist.html">Wishlist Page</a></li>
                                    </ul>
                                    <!-- Mobile Menu Dropdown End -->
                                </li>
                                <li><a href="blog.html">Blog</a>
                                    <!-- Mobile Menu Dropdown Start -->
                                    <ul>
                                        <li><a href="blog-details.html">Blog Details Page</a></li>
                                    </ul>
                                    <!-- Mobile Menu Dropdown End -->
                                </li>
                                <li><a href="#">pages</a>
                                    <!-- Mobile Menu Dropdown Start -->
                                    <ul>
                                        <li><a href="login.html">login Page</a></li>
                                        <li><a href="register.html">Register Page</a></li>
                                        <li><a href="404.html">404 Page</a></li>
                                    </ul>
                                    <!-- Mobile Menu Dropdown End -->
                                </li>
                                <li><a href="about.html">about us</a></li>
                                <li><a href="contact.html">contact us</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Mobile Menu  End -->
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div>
    <!-- Header Bottom End -->
</header>
