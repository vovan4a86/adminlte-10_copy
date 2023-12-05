@extends('adminlte::page')

@section('title', 'Настройки')

@section('content_header')
    <div class="row">
        <div class="col-sm-6"><h3>Настройки</h3></div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Главная</a></li>
                <li class="breadcrumb-item active">Настройки</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="settings-card card">
                <div class="card-body p-2">
                    <div class="card-header px-0">
                        <h3 class="card-title">Группы</h3>
                    </div>
                    <ul class="todo-list ui-sortable" id="setting-groups" data-widget="todo-list">
                        @foreach ($groups as $item)
                            @include('adminlte::settings.group_row', ['group' => $item, 'active' => $group])
                        @endforeach
                    </ul>
                </div>

                <div class="card-footer clearfix">
                    <form action="{{ route('admin.settings.groupSave') }}" onsubmit="return settingsGroupCreate(this)">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" required name="name" value="" placeholder="Название группы...">
                            <span class="input-group-btn">
                                <button class="btn btn-success btn-sm" type="submit">Создать</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="settings-content" class="col-md-9">
            @if ($group->id)
                @include('adminlte::settings.group_items', ['group' => $group, 'settings' => $settings])
            @endif
        </div>
    </div>
@stop

@section('js')
    <script src="/vendor/interfaces/interface.js" defer></script>
    <script src="/vendor/interfaces/interface_settings.js" defer></script>
@stop
