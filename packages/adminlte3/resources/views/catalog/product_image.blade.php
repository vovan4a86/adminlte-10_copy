<div class="images_item" data-id="{{ $image->id }}">
	<img class="img-polaroid" src="{{ $image->thumb(2) }}"
		 style="cursor:pointer;" data-image="{{ $image->image_src }}"
		 onclick="popupImage('{{ $image->image_src }}')" alt="image">
	<a class="images_del" href="{{ route('admin.catalog.product-image-delete', [$image->id]) }}"
	   onclick="return productImageDel(this)">
		<span class="fa fa-trash text-red"></span>
	</a>
</div>

