<div class="row">
    <div class="col-sm-12 col-md-5">
        <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Показано
            с {{ $on_page_from }} по {{ $on_page_to }} из {{ $items_count }} строк
        </div>
    </div>
    <div class="col-sm-12 col-md-7">
        <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            <ul class="pagination">
                @if ($current_page > 1)
                    <li class="paginate_button page-item previous disabled" id="example2_previous">
                        <a href="{{ $url.Pagination::query(['p' => (($current_page - 1) > 1 ? $current_page - 1 : false)]) }}"
                           aria-controls="example2" data-dt-idx="0" tabindex="0"
                           class="page-link">Назад</a>
                    </li>
                @else
                    <li class="paginate_button page-item previous disabled" id="example2_previous">
                        <a href="#" aria-controls="example2" data-dt-idx="0" tabindex="0" onclick="return false"
                           class="page-link">Назад</a>
                    </li>
                @endif

                @for ($i = max(1, $current_page - 10); $i <= min($pages_count, $current_page + 10); $i++)
                    @if ($i != $current_page)
                        <li class="paginate_button page-item ">
                            <a href="{{ $url.Pagination::query(['p' => ($i > 1 ? $i : false)]) }}"
                               aria-controls="example2"
                               data-dt-idx="2" tabindex="0"
                               class="page-link">{{ $i }}</a>
                        </li>
                    @else
                        <li class="paginate_button page-item active">
                            <a href="#"
                               aria-controls="example2"
                               data-dt-idx="1" tabindex="0"
                               class="page-link">{{ $i }}</a>
                        </li>
                    @endif
                @endfor

                @if ($current_page < $pages_count)
                    <li class="paginate_button page-item next" id="example2_next">
                        <a href="{{ $url.Pagination::query(['p' => $current_page + 1]) }}"
                           aria-controls="example2"
                           data-dt-idx="7"
                           tabindex="0"
                           class="page-link">Вперед</a>
                    </li>
                @else
                    <li class="paginate_button page-item next" id="example2_next">
                        <a href="#"
                           onclick="return false"
                           aria-controls="example2"
                           data-dt-idx="7"
                           tabindex="0"
                           class="page-link">Вперед</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
