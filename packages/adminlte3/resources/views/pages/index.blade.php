@extends('adminlte::page')

@section('title', 'Структура сайта')

@section('content_header')
    <div class="admin-page-head row">
        <div class="col-sm-3">
            <h5 class="admin-page-title">Структура сайта</h5>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="box box-solid card">
                <div class="box-body">
                    <div id="pages-tree"></div>
                </div>
                <ul id="pagesContext" class="contextMenu">
                    <li><a href="#add"><i class="fa fa-plus text-green mr-1"></i>Добавить</a></li>
                    <li><a href="#edit"><i class="fa fa-pen text-yellow mr-1"></i>Редактировать</a></li>
                    <li><a href="#delete"><i class="fa fa-trash text-red mr-1"></i>Удалить</a></li>
                </ul>
            </div>
        </div>

        <div id="page-content" class="col-md-9">
            {!! $content ?? '' !!}
        </div>
    </div>
@stop

@section('css')
    <link href="/vendor/plugins/fancytree/skin-win8/ui.fancytree.css" rel="stylesheet" type="text/css">
    <link href="/vendor/plugins/contextmenu/jquery.contextMenu.css" rel="stylesheet" type="text/css">
@stop

@section('js')
        <script src="/vendor/plugins/fancytree/jquery.fancytree-all-deps.js"></script>
        <script src="/vendor/plugins/fancytree/modules/jquery.fancytree.dnd.js"></script>
        <script src="/vendor/plugins/fancytree/modules/jquery.fancytree.persist.js"></script>
        <script src="/vendor/plugins/contextmenu/jquery.contextMenu-custom.js"></script>

        <script src="/vendor/interfaces/interface.js"></script>
        <script src="/vendor/interfaces/interface_pages.js"></script>
        <script src="/vendor/interfaces/interface_settings.js"></script>
@stop
