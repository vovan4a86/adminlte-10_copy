<div class="row chars-add align-items-center">
    <div class="col-6 d-flex">
        <input class="form-control mr-1" type="text" name="char-name" placeholder="Название">
        <input class="form-control ml-1" type="text" name="char-value" placeholder="Значение">
    </div>
    <div class="col-6">
        <a class="btn btn-sm btn-info" data-url="{{ route('admin.catalog.product-add-char', $product->id) }}"
           onclick="addProductChar(this, event)">
            <i class="fa fa-plus-circle"></i> Добавить
        </a>
    </div>
</div>
<hr class="my-3">
<div class="card chars-items">
    <div class="card-body p-0">
        <table class="table table-sm">
            <thead>
            <tr>
                <th style="width: 70px">#</th>
                <th>Название</th>
                <th>Значение</th>
                <th style="width: 40px"></th>
            </tr>
            </thead>
            <tbody id="product_chars" data-url="{{ route('admin.catalog.product-order-chars') }}">
            @foreach($product->chars as $char)
                @include('adminlte::catalog.tab_chars.item')
            @endforeach
            </tbody>
        </table>
    </div>

</div>
