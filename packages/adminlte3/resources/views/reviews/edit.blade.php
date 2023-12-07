@extends('adminlte::page')

@section('title', 'Редактировать отзыв')

@section('content_header')
    <div class="admin-page-head row">
        <div class="col-sm-3">
            <h5 class="admin-page-title">Отзыв <small style="font-style: italic;">{{ $review->id ? 'Редактировать' : 'Новый' }}</small>
            </h5>
        </div>
        <div class="col-sm-9">
            <ul class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.index') }}">Главная</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.reviews.index') }}">Отзывы</a>
                </li>
                <li class="breadcrumb-item active">{{ $review->id ? 'Редактировать' : 'Новый' }}</li>
            </ul>
        </div>
    </div>
@stop

@section('content')
    {!! Form::open(['route' => 'admin.reviews.save', 'onsubmit' => 'reviewsSave(this, event)']) !!}
    {{ Form::hidden('id', $review->id) }}

    <div class="card card-primary card-outline card-tabs">
        <div class="card-header p-0 pt-1 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tab-param"
                       data-toggle="pill" href="#tabs-three-params" role="tab"
                       aria-controls="custom-tabs-three-home" aria-selected="true">Параметры</a>
                </li>
            </ul>
            <div class="tab-custom-content text-right">
                @if($review->id)
                    <a class="text-danger mr-2" href="{{ $review->url }}" target="_blank">Посмотреть</a>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-three-tabContent">
                {{--param_tab--}}
                <div class="tab-pane fade show active" id="tabs-three-params" role="tabpanel"
                     aria-labelledby="tab-param">

                    {{ Form::groupText('name', $review->name, 'Название', []) }}
                    {{ Form::groupRichtext('text', $review->text, 'Текст') }}

                    {{ Form::groupBool('published', $review->published, 'Показывать отзыв') }}
                    {{ Form::groupBool('on_main', $review->on_main, 'Показывать на главной') }}
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
    <script src="/vendor/interfaces/interface_reviews.js"></script>
@stop
