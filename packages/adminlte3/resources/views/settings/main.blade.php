@extends('adminlte::page')

@section('title', 'Settings')

@section('content_header')
    <h1>Настройки</h1>
@stop

@section('content')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Главная</a></li>
        <li class="breadcrumb-item active">Настройки</li>
    </ol>

    <div class="row">
        <div class="col-md-3">
            <div class="box box-solid">
                <div class="box-header"><h3 class="box-title">Группы</h3></div>

                <div class="box-body">
                    <ul id="setting-groups" class="tree-lvl ui-sortable">
                        @foreach ($groups as $item)
                            @include('admin.settings.group_row', ['group' => $item, 'active' => $group])
                        @endforeach
                    </ul>
                </div>

                <div class="box-footer">
                    <form action="{{ route('admin.settings.groupSave') }}" onsubmit="return settingsGroupCreate(this)">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" name="name" value="" placeholder="Название группы...">
                            <span class="input-group-btn">
								<button class="btn btn-success btn-flat" type="submit">Создать</button>
							</span>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="settings-content" class="col-md-9">
            @if ($group->id)
                @include('admin.settings.group_items', ['group' => $group, 'settings' => $settings])
            @endif
        </div>
    </div>
@stop

{{--@section('css')--}}
{{--    <link href="/js/plugins/summernote/summernote-bs4.min.css" rel="stylesheet" type="text/css">--}}
{{--    <link href="/js/plugins/fancytree/skin-win8/ui.fancytree.css" rel="stylesheet" type="text/css">--}}
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery.fancytree@2.38.3/dist/skin-win8/ui.fancytree.min.css">--}}
{{--@stop--}}

@section('js')
    <script src="/js/plugins/fancytree/jquery.fancytree-all-deps.js"></script>
    <script src="/js/plugins/summernote/summernote-bs4.min.js"></script>
    <script src="/js/plugins/custom-file-input/bs-custom-file-input.min.js"></script>
    <script src="/js/interface.js" defer></script>
    <script src="/js/interface_settings.js" defer></script>

    {{--    <script src="https://code.jquery.com/ui/1.10.2/jquery-ui.min.js" integrity="sha256-FgiaQnQazF/QCrF9qSvpRY6PACn9ZF8VnlgqfqD1LsE=" crossorigin="anonymous"></script>--}}
    {{--    <script src="https://cdn.jsdelivr.net/npm/jquery.fancytree@2.38.3/dist/jquery.fancytree-all.min.js"></script>--}}
    {{--    @vite(['resources/css/admin/admin-app.css', 'resources/js/admin/admin-app.js'])--}}
@stop
