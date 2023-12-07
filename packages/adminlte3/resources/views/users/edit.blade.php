@extends('adminlte::page')

@section('title', 'Пользователь')

@section('content_header')
    <div class="admin-page-head row">
        <div class="col-sm-3">
            <h5 class="admin-page-title">Пользователь <small style="font-style: italic;">{{ $user->id ? 'Редактировать' : 'Новый' }}</small>
            </h5>
        </div>
        <div class="col-sm-9">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.index') }}">Главная</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.reviews.index') }}">Пользователь</a>
                </li>
                <li class="breadcrumb-item active">{{ $user->id ? 'Редактировать' : 'Новый' }}</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    {!! Form::open(['route' => 'admin.user.save', 'onsubmit' => 'userSave(this, event)']) !!}
    {{ Form::hidden('id', $user->id) }}

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

                    {{ Form::groupText('name', $user->name, 'Имя') }}
                    {{ Form::groupText('email', $user->email, 'Email') }}

                    {{ Form::groupSelect('is_admin', ['0' => 'Пользователь', '1' => 'Администратор'], $user->is_admin, 'Статус', ['disabled' => $user->id == 1]) }}

                    {{ Form::groupBool('is_active', $user->is_active, 'Активен') }}
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
    <script src="/vendor/interfaces/interface_users.js"></script>
@stop
