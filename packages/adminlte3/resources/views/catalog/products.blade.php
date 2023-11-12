{{--@section('page_name')--}}
{{--    <h1>Каталог--}}
{{--        <small>{{ $catalog->name }}</small>--}}
{{--    </h1>--}}
{{--@stop--}}
{{--@section('breadcrumb')--}}
{{--    <ol class="breadcrumb">--}}
{{--        <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i>Главная</a></li>--}}
{{--        <li><a href="{{ route('admin.catalog') }}"><i class="fa fa-list"></i>Каталог</a></li>--}}
{{--        @foreach($catalog->getParents(false, true) as $parent)--}}
{{--            <li><a href="{{ route('admin.catalog.products', [$parent->id]) }}">{{ $parent->name }}</a></li>--}}
{{--        @endforeach--}}
{{--        <li class="active">{{ $catalog->name}}</li>--}}
{{--    </ol>--}}
{{--@stop--}}

<div class="box box-solid">
    <div class="box-body">
        <a href="{{ route('admin.catalog.product-edit', ['catalog' => $catalog->id]) }}"
           class="btn btn-sm btn-primary mb-2">Добавить товар</a>

        @if (count($products))
            <table class="table table-striped table-v-middle">
                <thead>
                <tr>
                    <th width="100">Изображение</th>
                    <th>Название</th>
                    <th width="130">Сортировка</th>
                    <th width="50"></th>
                </tr>
                </thead>
                <tbody id="catalog-products">
                @foreach ($products as $item)
                    <tr data-id="{{ $item->id }}">
                        <td>
                            @if ($item->thumb(1))
                                <img src="{{ $item->thumb(1) }}" width="100" alt="image">
                            @elseif($catalog->thumb(1))
                                <img class="img-polaroid" src="{{ $catalog->thumb(1) }}"
                                     width="100" alt="image">
                            @endif
                        </td>
                        <td><a href="{{ route('admin.catalog.product-edit', [$item->id]) }}" style="{{ $item->published != 1 ? 'text-decoration:line-through;' : '' }}">{{ $item->name }}</a>
                        </td>
                        <td>
                            <form class="input-group input-group-sm"
                                  action="{{ route('admin.catalog.update-order', [$item->id]) }}"
                                  onsubmit="updateOrder(this, event)">
                                <input type="number" name="order" class="form-control" step="1" value="{{ $item->order }}">
                                <span class="input-group-btn">
                                    <button class="btn btn-sm btn-success btn-flat" type="submit">
                                       <i class="fa fa-check"></i>
                                    </button>
                                </span>
                            </form>
                        </td>
                        <td>
                            <a class="glyphicon glyphicon-trash" href="{{ route('admin.catalog.product-delete', [$item->id]) }}"
                               style="font-size:20px; color:red;" title="Удалить" onclick="productDelete(this)"></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!! \Adminlte3\Pagination::render('adminlte::pagination') !!}
        @else
            <p class="text-yellow">В разделе нет товаров!</p>
        @endif
    </div>
</div>
