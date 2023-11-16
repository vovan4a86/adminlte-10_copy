<div class="card">
    <div class="card-body table-responsive p-0">

        <a href="{{ route('admin.catalog.product-edit', ['catalog' => $catalog->id]) }}"
           class="btn btn-sm btn-primary m-2">Добавить товар <i class="fa fa-plus-circle"></i></a>

        @if (count($products))
            <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th style="width: 150px">Изображение</th>
                    <th>Название</th>
                    <th style="width: 120px; text-align: center">Порядок</th>
                    <th style="width: 50px; text-align: center">X</th>
                </tr>
                </thead>
                <tbody id="catalog-products">
                @foreach ($products as $item)
                    <tr>
                        <td>
                            @if ($item->thumb(1))
                                <img src="{{ $item->thumb(1) }}" height="100" alt="image">
                            @elseif($catalog->thumb(1))
                                <img class="img-polaroid" src="{{ $catalog->thumb(1) }}"
                                     height="100" alt="image">
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.catalog.product-edit', [$item->id]) }}"
                               style="{{ $item->published != 1 ? 'text-decoration:line-through;' : '' }}">{{ $item->name }}</a>
                        </td>
                        <td>
                            <form class="input-group input-group-sm"
                                  action="{{ route('admin.catalog.update-order', [$item->id]) }}"
                                  onsubmit="updateOrder(this, event)">
                                <input type="number" name="order" class="form-control" step="1"
                                       value="{{ $item->order }}">
                                <span class="input-group-btn">
                                    <button class="btn btn-sm btn-success btn-flat" type="submit">
                                       <i class="fa fa-check"></i>
                                    </button>
                                </span>
                            </form>
                        </td>
                        <td>
                            <a class="fa fa-trash"
                               href="{{ route('admin.catalog.product-delete', [$item->id]) }}"
                               style="font-size:20px; color:red;" title="Удалить"
                               onclick="productDelete(this)"></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="my-2 mx-auto">
                {!! \Adminlte3\Pagination::render() !!}
            </div>
        @else
            <p class="text-yellow">В разделе нет товаров!</p>
        @endif
    </div>
</div>

