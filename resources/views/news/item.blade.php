@extends('template')
@section('content')
    @include('blocks.bread')
    <main>
        <section class="news">
            <div class="news__container container text-block">
                <div class="news__head">
                    <h1>{{ $h1 }}</h1>
                    <time datetime="{{ $item->dateFormat('Y-m-d') }}">{{ $item->dateFormat() }}</time>
                </div>
                {!! $text !!}
                <div class="news__action">
                    <a class="news__back" href="{{ route('news') }}" title="Вернуться к ленте новостей">
                        <svg width="31" height="12" viewBox="0 0 31 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.505024 6.49497C0.231657 6.22161 0.231657 5.77839 0.505024 5.50503L4.9598 1.05025C5.23316 0.776886 5.67638 0.776886 5.94975 1.05025C6.22311 1.32362 6.22311 1.76684 5.94975 2.0402L1.98995 6L5.94975 9.9598C6.22311 10.2332 6.22311 10.6764 5.94975 10.9497C5.67638 11.2231 5.23316 11.2231 4.9598 10.9497L0.505024 6.49497ZM31 6.7H0.999998V5.3H31V6.7Z"
                                  fill="currentColor"/>
                        </svg>
                        <span>Вернуться к ленте новостей</span>
                    </a>
                </div>
            </div>
        </section>
    </main>
@endsection
