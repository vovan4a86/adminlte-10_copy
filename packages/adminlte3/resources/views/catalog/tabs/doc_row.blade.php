<span class="docs_item" data-id="{{ $doc->id }}">
	<div style="text-align: center; font-size: 12px; color: red">{{ $doc->name }}</div>
	<a href="{{ $doc->fileSrc($product->catalog->alias) }}" target="_blank">
		<img class="img-polaroid" src="{{ \Adminlte3\Models\ProductDoc::DOC_ICON }}" width="100"
			 style="cursor:pointer;" title="Открыть в новом окне">
	</a>
	<a class="docs_del" href="{{ route('admin.catalog.product-del-doc', [$doc->id]) }}"
       onclick="return productDocDel(this)">
		<span class="fa fa-trash"></span>
	</a>
	<a class="docs_edit" href="{{ route('admin.catalog.product-edit-doc', [$doc->id]) }}"
       onclick="productDocEdit(this, event)"><span class="fa fa-pen-alt"></span></a>
</span>
