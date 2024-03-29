<div class="card">
    <div class="card-body table-responsive p-0">
        <h5 class="m-2">Поиск товаров</h5>
        <div class="btn-group m-2">
            @if(count($products))
                <button class="btn btn-primary btn-sm" onclick="checkSelectAll()">Выделить всё</button>
                <button class="btn btn-warning btn-sm" onclick="checkDeselectAll()">Снять выделение</button>
                <button class="btn btn-primary btn-sm js-move-btn"
                        data-toggle="modal" data-target="#moveDialog"
                        disabled>Переместить
                </button>
            @endif
        </div>

        <form action="{{ route('admin.catalog.search') }}">
            <div class="row input-group align-items-center">
                <input type="text" class="form-control input-sm ml-3" name="q" placeholder="Наименование"
                       value="{{ Request::get('q') }}">
                <span class="input-group-btn mx-2">
                <button class="btn btn-info btn-sm" type="submit">Поиск</button>
                <a href="{{ route('admin.catalog.search') }}" class="btn btn-danger btn-sm" type="button">Сброс</a>
              </span>
            </div>
        </form>


        @if (count($products))
            <table class="table table-striped table-v-middle">
                <thead>
                <tr>
                    <th width="40"></th>
                    <th width="100"></th>
                    <th>Название</th>
                    <th>Категория</th>
                    <th width="120">Цена</th>
                    <th width="120">Сортировка</th>
                    <th width="50"></th>
                </tr>
                </thead>
                <tbody id="catalog-products">
                @foreach ($products as $item)
                    <tr data-id="{{ $item->id }}">
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" class="js_select" value="{{ $item->id }}"
                                           onclick="checkSelectProduct()">
                                </label>
                            </div>
                        </td>
                        <td>
                            @if ($item->image)
                                <img src="{{ $item->thumb(1) }}" height="50">
                            @endif
                        </td>
                        <td><a href="{{ route('admin.catalog.product-edit', [$item->id]) }}"
                               onclick="return catalogContent(this)"
                               style="{{ $item->published != 1 ? 'text-decoration:line-through;' : '' }}">{{ $item->name }}</a>
                        </td>
                        <td>{{ $item->catalog ? $item->catalog->name: '' }}</td>
                        <td>{{ number_format($item->price, 0, '.', ' ') }}</td>
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
                               onclick="productDelete(this, event)"></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center my-2">
                {!! Pagination::render() !!}
            </div>
        @else
            <p class="text-yellow m-3">
                @if(Request::get('q'))
                    Ничего не найдено
                @endif
            </p>
        @endif
    </div>
</div>

@if($products)
    <div id="moveDialog" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Переместить товары</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Выберите категорию</label>
                        {!! Form::select('move_category_id', $catalog_list, 0, ['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success pull-left" onclick="moveProducts(this, event)">
                        Переместить
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Отмена</button>
                </div>
            </div>

        </div>
    </div>
@endif
