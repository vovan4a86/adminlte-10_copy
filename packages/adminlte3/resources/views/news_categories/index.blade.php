@extends('adminlte::page')

@section('title', 'Новости')

@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Категории новостей</h1>
                    <a href="{{ route('admin.news-categories.edit') }}" class="btn btn-sm btn-info mt-2">
                            Добавить категорию <i class="fa fa-plus"></i></a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Главная</a></li>
                        <li class="breadcrumb-item active">Категории новостей</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@stop

@section('content')
    <div class="card">
        @if (count($cats))
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                    <tr>
                        <th>Название</th>
                        <th style="width: 50px; text-align: center">X</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($cats as $item)
                        <tr>
                            <td><a href="{{ route('admin.news-categories.edit', [$item->id]) }}">{{ $item->name }}</a>
                            </td>
                            <td>
                                <a class="fa fa-trash" href="{{ route('admin.news-categories.delete', [$item->id]) }}"
                                   style="font-size:20px; color:red;" title="Удалить" onclick="deleteNewsCategory(this, event)"></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <h5 class="m-4">Нет категорий!</h5>
        @endif
    </div>
@stop
@section('js')
    <script src="/vendor/interfaces/interface.js"></script>
    <script src="/vendor/interfaces/interface_news.js"></script>
@stop
