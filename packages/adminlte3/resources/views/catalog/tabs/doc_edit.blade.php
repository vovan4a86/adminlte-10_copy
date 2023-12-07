<form action="{{ route('admin.catalog.product-save-doc', [$doc->id]) }}"
      onsubmit="productDocDataSave(this, event)" style="width:600px;">
    <label for="gallery-doc">Название</label>
    <input id="gallery-doc" class="form-control" type="text" name="name" value="{{ $doc->name }}">
    <button class="btn btn-primary" style="margin-top: 20px;" type="submit">Сохранить</button>
</form>
