@extends('template')
@section('content')
    @include('blocks.bread')
    <div class="main-shop-page pb-60">
        <div class="container">
            <div class="row">
                <!-- Sidebar Shopping Option Start -->
                <div class="col-lg-12">
                    <div class="grid-list-top border-default universal-padding fix mb-30">
                        <div class="grid-list-view f-left">
                            <ul class="list-inline nav">
                                <li>
                                    <span class="grid-item-list">
                                        Категорий: {{ count($categories) }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <div class="main-toolbar-sorter f-right">
                            <div class="toolbar-sorter">
                                <label>Сортировка</label>
                                <select class="sorter" name="name-sorter">
                                    <option value="Position" selected="selected">position</option>
                                    <option value="Product Name">Product Name</option>
                                    <option value="Price">Price</option>
                                </select>
                                <span>
                                    <a href="#" class="sorter-direction">
                                        <i class="fa fa-arrow-up"></i>
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="main-categories">
                        <div class="tab-content fix">
                            <div class="brand-area pb-60">
                                <div class="container">
                                    <div class="all-categories">
                                        @foreach($categories as $cat)
                                            <div class="single-category">
                                                <a href="{{ $cat->url }}">
                                                    <img class="img" src="{{ $cat->image_scr ?: \Adminlte3\Models\ProductImage::NO_IMAGE }}"
                                                         alt="{{ $cat->name }}">
                                                </a>
                                                <a href="{{ $cat->url }}">{{ $cat->name }} ({{ $cat->getRecurseProductsCount() }})</a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
