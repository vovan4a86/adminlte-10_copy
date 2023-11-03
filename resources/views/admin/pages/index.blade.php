@extends('adminlte::page')

@section('title', 'Pages')

@section('content_header')
    <h1>Pages::<span id="echoActive"></span></h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="box box-solid">
                <div class="box-body">
                    <div id="tree"></div>
                </div>
            </div>
        </div>

        <div id="page-content" class="col-md-9">
            {!! $content ?? '' !!}
        </div>
    </div>
@stop

@section('css')
    <link href="/js/plugins/summernote/summernote-bs4.min.css" rel="stylesheet" type="text/css">
    <link href="/js/plugins/fancytree/skin-win8/ui.fancytree.css" rel="stylesheet" type="text/css">
    <link href="/css/bootstrap-icons.min.css" rel="stylesheet" type="text/css">
@stop

@section('js')
    <script src="/js/plugins/fancytree/jquery.fancytree-all-deps.js"></script>
    <script src="/js/plugins/summernote/summernote-bs4.min.js"></script>
    <script src="/js/plugins/custom-file-input/bs-custom-file-input.min.js"></script>
    <script src="/js/interface.js" defer></script>
    <script src="/js/interface_pages.js" defer></script>
    <script src="/js/interface_settings.js" defer></script>

    {{--    <script src="https://code.jquery.com/ui/1.10.2/jquery-ui.min.js" integrity="sha256-FgiaQnQazF/QCrF9qSvpRY6PACn9ZF8VnlgqfqD1LsE=" crossorigin="anonymous"></script>--}}
    {{--    <script src="https://cdn.jsdelivr.net/npm/jquery.fancytree@2.38.3/dist/jquery.fancytree-all.min.js"></script>--}}
    {{--    @vite(['resources/css/admin/admin-app.css', 'resources/js/admin/admin-app.js'])--}}
@stop
