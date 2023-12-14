@extends('adminlte::page')

@section('title', 'Новости')

@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Категории новостей</h1>
                    <a href="{{ route('admin.news-categories.edit') }}" class="btn btn-sm btn-info">
                        Добавить категорию <i class="fa fa-plus"></i></a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Главная</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.news-categories') }}">Категории новостей</a></li>
                        <li class="breadcrumb-item active">{{ $category->id ? 'Редактировать' : 'Новая' }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@stop

@section('content')
    {!! Form::open(['route' => 'admin.news-categories.save', 'onsubmit' => 'newsSave(this, event)']) !!}
    {{ Form::hidden('id', $category->id) }}
    <div class="card card-primary card-outline card-tabs">
        <div class="card-header p-0 pt-1 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tab-param"
                       data-toggle="pill" href="#tabs-three-params" role="tab"
                       aria-controls="custom-tabs-three-home" aria-selected="true">Параметры</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-three-tabContent">
                {{--param_tab--}}
                <div class="tab-pane fade show active" id="tabs-three-params" role="tabpanel"
                     aria-labelledby="tab-param">
                    <div class="row">
                        {{ Form::groupText('name', $category->name, 'Название', [], 'col-6') }}
                        {{ Form::groupText('alias', $category->alias, 'Alias', [], 'col-6') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success btn-sm">
                <i class="fa fa-save"></i>
                Сохранить</button>
        </div>
    </div>
    {!! Form::close() !!}
@stop

@section('js')
    <script src="/vendor/interfaces/interface.js"></script>
    <script src="/vendor/interfaces/interface_news.js"></script>
@stop
