<div class="card">
    <div class="card-body table-responsive p-0">
        <h5 class="m-2">Товары ({{ count($products) }})</h5>

        <a href="{{ route('admin.catalog.product-edit', ['catalog' => $catalog->id]) }}"
           class="btn btn-sm btn-primary m-2">Добавить товар <i class="fa fa-plus-circle"></i>
        </a>
        @if(count($products))
            <button class="btn btn-primary btn-sm" onclick="checkSelectAll()">Выделить всё</button>
            <button class="btn btn-warning btn-sm" onclick="checkDeselectAll()">Снять выделение</button>
            <button class="btn btn-primary btn-sm js-move-btn"
                    data-toggle="modal" data-target="#moveDialog"
                    disabled>Переместить
            </button>
            <button class="btn btn-danger btn-sm js-delete-btn"
                    onclick="deleteProducts(this, event)"
                    disabled>Удалить
            </button>
            <button class="btn btn-danger btn-sm js-delete-btn"
                    onclick="deleteProductsImage(this, event, {{ $catalog->id }})"
                    disabled>Удалить IMGs
            </button>
            <div class="form-group form-inline m-2" style="float: right; margin-left: 15px;">
                <form>
                    <label>Показывать по:
                        <select name="per_page" class="form-control-sm" onchange="this.form.submit();">
                            @foreach([50,100,150,300,500] as $i)
                                <option
                                    value="{{ $i }}" {{ session('per_page', 50) == $i? 'selected': '' }}>{{ $i }}</option>
                            @endforeach
                        </select>
                    </label>
                </form>
            </div>
        @endif

        <form action="{{ route('admin.catalog.search') }}">
            <div class="row input-group align-items-center">
                <input type="text" class="form-control input-sm ml-3" name="q" placeholder="Наименование"
                       value="{{ Request::get('q') }}">
                <span class="input-group-btn mx-2">
                <button class="btn btn-info btn-sm" type="submit">Поиск</button>
                <a href="{{ route('admin.catalog.products', ['id' => $catalog->id]) }}"
                   class="btn btn-danger btn-sm"
                   type="button">Сброс</a>
              </span>
            </div>
        </form>

        @if (count($products))
            <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th width="40"></th>
                    <th style="width: 120px">Изображение</th>
                    <th>Название</th>
                    <th>Артикул</th>
                    <th width="60" style="text-align: center">Цена</th>
                    <th style="width: 120px; text-align: center">Порядок</th>
                    <th style="width: 50px; text-align: center">X</th>
                </tr>
                </thead>
                <tbody id="catalog-products">
                @foreach ($products as $item)
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" class="js_select" value="{{ $item->id }}"
                                           onclick="checkSelectProduct()">
                                </label>
                            </div>
                        </td>
                        <td style="text-align: center">
                            @if ($img = $item->images()->first())
                                <img src="{{ $img->thumb(1, $catalog->alias) }}" height="50">
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.catalog.product-edit', [$item->id]) }}"
                               style="{{ $item->published != 1 ? 'text-decoration:line-through;' : '' }}">{{ $item->name }}</a>
                        </td>
                        <td>{{ $item->article }}</td>
                        <td style="text-align: center">{{ $item->price }}</td>
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
            <p class="text-yellow m-3">В разделе нет товаров!</p>
        @endif
    </div>
</div>


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
