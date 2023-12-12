<li class="header-favorites"><a href="{{ route('favorites') }}">
        <i class="fa fa-heart-o"></i>
        @if (count(session('favorites', [])))
            <span class="wish-counter">{{ count(session('favorites', [])) }}</span>
        @endif
    </a>
</li>
