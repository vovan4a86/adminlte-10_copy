@if(isset($bread) && count($bread))
    <div class="breadcrumb-area ptb-30 ptb-sm-30">
        <div class="container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="{{ route('main') }}">Главная</a></li>
                    @foreach($bread as $item)
                        <li class="{{ $loop->last ? 'active' : null }}">
                            <a href="{{ $loop->last ? 'javascript:void(0)': $item['url'] }}">{{ $item['name'] }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif
