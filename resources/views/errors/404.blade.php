@extends('template')
@section('content')
    @include('blocks.bread')

    <div class="error404-area pb-60 pt-20">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="error-wrapper text-center">
                        <div class="error-text">
                            <h1>404</h1>
                            <h2>Упс! Страница не найдена</h2>
                            <p>Извините, но страница, которую вы ищете, не существует, была удалена, название изменено или временно недоступна.</p>
                        </div>
                        <div class="search-error">
                            <form id="search-form" action="#">
                                <input type="text" placeholder="Search">
                                <button><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <div class="error-button">
                            <a href="{{ route('main') }}">На главную</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('blocks.brands')
@endsection
