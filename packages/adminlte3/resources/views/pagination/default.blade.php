<div class="clearfix" style="text-align:center;">
	<ul class="pagination pagination-sm m-0">
		@if ($current_page > 1)
			<li class="page-item"><a class="page-link" href="{{ $url.Pagination::query(['p' => (($current_page - 1) > 1 ? $current_page - 1 : false)]) }}">«</a></li>
		@else
			<li class="page-item"><a class="page-link" href="#" onclick="return false">«</a></li>
		@endif

		@for ($i = max(1, $current_page-10); $i <= min($pages_count, $current_page+10); $i++)
			@if ($i != $current_page)
				<li class="page-item"><a class="page-link" href="{{ $url.Pagination::query(['p' => ($i > 1 ? $i : false)]) }}">{{ $i }}</a></li>
			@else
				<li class="page-item"><span class="page-link" style="background: #dee2e6">{{ $i }}</span></li>
			@endif
		@endfor

		@if ($current_page < $pages_count)
			<li class="page-item"><a class="page-link" href="{{ $url.Pagination::query(['p' => $current_page + 1]) }}">»</a></li>
		@else
			<li class="page-item"><a class="page-link" href="#" onclick="return false">»</a></li>
		@endif
	</ul>
</div>
