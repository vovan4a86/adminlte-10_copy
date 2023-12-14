@if ($paginator->hasPages() && $paginator->lastPage() > 1)
    @php
        // config
        $link_limit = 7; // maximum number of links (a little bit inaccurate, but will be ok for now)
        $half_total_links = floor($link_limit / 2);
        $from = $paginator->currentPage() - $half_total_links;
        $to = $paginator->currentPage() + $half_total_links;
        if ($paginator->currentPage() < $half_total_links) {
            $to += $half_total_links - $paginator->currentPage();
        }
        if ($paginator->lastPage() - $paginator->currentPage() < $half_total_links) {
            $from -= $half_total_links - ($paginator->lastPage() - $paginator->currentPage()) - 1;
        }
    @endphp

    @if ($paginator->lastPage() > 1)
        <ul class="blog-pagination ">
            @if ($paginator->currentPage() > 1)
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" title="Назад">
                        <i class="fa fa-angle-left"></i>
                    </a>
                </li>
            @endif
            @if($from > 1)
                <li><a href="{{ $paginator->url(1) }}">1</a></li>
            @endif

            @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                @if ($from < $i && $i < $to)
                    @if ($i == $paginator->currentPage())
                        <li class="active"><a href="javascript:void(0)">{{ $i }}</a></li>
                        @else
                        <li><a href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
                    @endif
                @endif
            @endfor
                <li><a href="javascript:void(0)">...</a></li>
            @if($to < $paginator->lastPage())
                <li><a href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a></li>
                @endif
            @if ($paginator->currentPage() < $paginator->lastPage())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" title="Далее">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
            @endif
        </ul>
    @endif
@endif
