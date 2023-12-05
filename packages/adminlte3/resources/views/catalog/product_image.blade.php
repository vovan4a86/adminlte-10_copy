<div class="images_item" data-id="{{ $image->id }}">
	<img class="img-polaroid" src="{{ $image->thumb(1, $product->catalog->alias) }}"
		 style="cursor:pointer;" data-image="{{ $image->imageSrc($product->catalog->alias) }}"
		 onclick="popupImage('{{ $image->imageSrc($product->catalog->alias) }}')" alt="image">
	<a class="images_del" href="{{ route('admin.catalog.product-image-delete', [$image->id]) }}"
	   onclick="return productImageDel(this)">
		<span class="fa fa-trash text-red"></span>
	</a>
</div>

