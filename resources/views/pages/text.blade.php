@extends('template')
@section('content')
    @include('blocks.bread')
    <main>
        <section class="news">
            <div class="news__container container text-block">
                <div class="news__head">
                    <h1>{{ $page->h1 }}</h1>
                </div>
                {!! $page->text !!}
            </div>
        </section>
    </main>
@stop
