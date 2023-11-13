@extends('adminlte::page')

@section('title', 'Новости')

@section('page_name')
	<h1>Новости
		<small><a href="{{ route('admin.news.edit') }}">Добавить новость</a></small>
	</h1>
@stop

@section('breadcrumb')
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Главная</a></li>
		<li class="active">Новости</li>
	</ol>
@stop

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h5>Новости <a href="{{ route('admin.news.edit') }}" class="btn btn-sm btn-info">
                        Добавить новость <i class="fa fa-plus"></i></a>
            </h5>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Главная</a>
                </li>
                <li class="breadcrumb-item active">Новости</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        @if (count($news))
            <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th style="width: 100px; text-align: center">Дата</th>
                    <th style="width: 200px; text-align: center">Изображение</th>
                    <th>Название</th>
                    <th style="width: 50px; text-align: center">X</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($news as $item)
                    <tr>
                        <td>{{ $item->dateFormat() }}</td>
                        <td style="text-align: center;">
                            @if($item->image)
                                <img src="{{ $item->thumb(1) }}" alt="image"></td>
                        @endif
                        <td><a href="{{ route('admin.news.edit', [$item->id]) }}">{{ $item->name }}</a></td>
                        <td>
                            <a class="fa fa-trash" href="{{ route('admin.news.delete', [$item->id]) }}"
                               style="font-size:20px; color:red;" title="Удалить" onclick="deleteNews(this)"></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @else
            <p>Нет новостей!</p>
        @endif

    </div>
@stop
