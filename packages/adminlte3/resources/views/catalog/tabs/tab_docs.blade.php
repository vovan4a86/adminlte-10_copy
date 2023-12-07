<input id="product-doc" type="hidden" name="document">
@if ($product->id)
    <div class="form-group">
        <label class="btn btn-success">
            <input id="doc_upload" type="file" multiple
                   data-url="{{ route('admin.catalog.product-add-doc', $product->id) }}"
                   accept=".pdf"
                   style="display:none;" onchange="productDocUpload(this, event)">
            Загрузить файлы
        </label>
        <p>Файлы: .pdf</p>
    </div>

    <div class="docs_list">
        @foreach ($product->docs as $doc)
            @include('adminlte::catalog.tabs.doc_row', ['doc' => $doc])
        @endforeach
    </div>
@else
    <p class="text-yellow">Документы можно будет загрузить после сохранения товара!</p>
@endif
