@section('title', 'Редактирование товара')

@section('content_header')
    <div class="admin-page-head row">
        <div class="col-sm-3">
            <h5 class="admin-page-title">Каталог <small style="font-style: italic;">{{ $product->id ? $product->name : 'Новый' }}</small>
            </h5>
        </div>
        <div class="col-sm-9">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.index') }}">Главная</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.catalog.index') }}">Каталог</a>
                </li>
                @foreach($product->getParents(false, true) as $parent)
                    <li class="breadcrumb-item"><a
                            href="{{ route('admin.catalog.products', [$parent->id]) }}">{{ $parent->name }}</a></li>
                @endforeach
                <li class="breadcrumb-item active">{{ $product->id ? $product->name : 'Новый товар' }}</li>
            </ol>
        </div>
    </div>
@stop

{!! Form::open(['route' => 'admin.catalog.product-save', 'onsubmit' => 'productSave(this, event)']) !!}
{{ Form::hidden('id', $product->id) }}

<div class="card card-secondary card-outline card-tabs">
    <div class="card-header p-0 pt-1 border-bottom-0">
        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="tab-param"
                   data-toggle="pill" href="#tabs-three-params" role="tab"
                   aria-controls="custom-tabs-params" aria-selected="true">Параметры</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tab-text"
                   data-toggle="pill" href="#tabs-three-text" role="tab"
                   aria-controls="custom-tabs-text" aria-selected="false">Текст</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tab-chars"
                   data-toggle="pill" href="#tabs-three-chars" role="tab"
                   aria-controls="custom-tabs-chars" aria-selected="false">Характеристики ({{ count($product->chars) }})</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tab-docs"
                   data-toggle="pill" href="#tabs-three-docs" role="tab"
                   aria-controls="custom-tabs-docs" aria-selected="false">Документы ({{ count($product->docs) }})</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tab-images"
                   data-toggle="pill" href="#tabs-three-images" role="tab"
                   aria-controls="custom-tabs-images" aria-selected="false">Изображения ({{ count($product->images) }})</a>
            </li>
        </ul>
        <div class="tab-custom-content text-right">
            @if($product->id)
                <a class="text-danger mr-2" href="{{ $product->url }}" target="_blank">Посмотреть</a>
            @endif
        </div>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-three-tabContent">
            {{--param_tab--}}
            <div class="tab-pane fade show active" id="tabs-three-params" role="tabpanel" aria-labelledby="tab-param">
                <div class="row">
                    {{ Form::groupText('name', $product->name, 'Название', [], 'col-6') }}
                    {{ Form::groupText('alias', $product->alias, 'Alias', [], 'col-6') }}
                </div>
                {{ Form::groupSelect('catalog_id', $catalogs_list, $product->catalog_id, 'Каталог') }}

                <div class="row">
                    <div class="col-6">
                        {{ Form::groupText('title', $product->title, 'Title') }}
                        {{ Form::groupText('description', $product->description, 'Description') }}
                        {{ Form::groupText('keywords', $product->keywords, 'Keywords') }}
                    </div>
                    <div class="col-6">
                        {{ Form::groupText('og_title', $product->og_title, 'OG Title') }}
                        {{ Form::groupText('og_description', $product->og_description, 'OG Description') }}
                    </div>
                </div>

                {{ Form::groupText('price', $product->price, 'Цена') }}
                {{ Form::groupText('is_discount', $product->is_discount, 'Скидка, %') }}


                {{ Form::groupBool('published', $product->published, 'Показывать товар') }}
                {{ Form::groupBool('in_stock', $product->in_stock, 'Наличие товара') }}
            </div>

            {{--text_tab--}}
            <div class="tab-pane fade" id="tabs-three-text" role="tabpanel" aria-labelledby="tab-text">
{{--                {{ Form::groupRichtext('announce', $product->announce, 'Анонс') }}--}}
                {{ Form::groupRichtext('text', $product->text, 'Текст') }}
            </div>

            {{--chars_tab--}}
            <div class="tab-pane fade" id="tabs-three-chars" role="tabpanel" aria-labelledby="tab-chars">
                @include('adminlte::catalog.tabs.tab_chars')
            </div>

            {{--docs_tab--}}
            <div class="tab-pane fade" id="tabs-three-docs" role="tabpanel" aria-labelledby="tab-docs">
                @include('adminlte::catalog.tabs.tab_docs')
            </div>

            {{--img_tab--}}
            <div class="tab-pane fade" id="tabs-three-images" role="tabpanel" aria-labelledby="tab-images">
                @if ($product->id)
                    <div class="form-group">
                        <label class="btn btn-info btn-sm">
                            <input id="image_upload" type="file" multiple accept=".png,.jpg,.jpeg"
                                   data-url="{{ route('admin.catalog.product-image-upload', $product->id) }}"
                                   style="display:none;" onchange="productImageUpload(this, event)">
                            Загрузить изображения <i class="fa fa-plus-circle"></i>
                        </label>
                    </div>

                    <div class="images_list" data-url="{{ route('admin.catalog.product-image-order') }}">
                        @foreach ($product->images as $image)
                            @include('adminlte::catalog.product_image', ['image' => $image])
                        @endforeach
                    </div>
                @else
                    <p class="text-yellow">Изображения можно будет загрузить после сохранения товара!</p>
                @endif
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-success btn-sm">
            <i class="fa fa-save"></i>
            Сохранить
        </button>
    </div>
</div>
{!! Form::close() !!}
