@extends('adminlte::page')

@section('title', 'Каталог')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h5>Каталог</h5>
        </div>
        @if(isset($bread) && count($bread))
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    @foreach($bread as $item)
                        @if(!$loop->last)
                            <li class="breadcrumb-item">
                                <a href="{{ $item['url'] }}">{{ $item['name'] }}</a>
                            </li>
                        @else
                            <li class="breadcrumb-item active">{{ $item['name'] }}</li>
                        @endif
                    @endforeach
                </ol>
            </div>
        @endif
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="box box-solid">
                <div class="box-body">
                    <div id="catalog-tree"></div>
                </div>
                <ul id="catalogContext" class="contextMenu">
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
    <link href="/vendor/plugins/summernote/summernote-bs4.min.css" rel="stylesheet" type="text/css">
    <link href="/vendor/plugins/fancytree/skin-win8/ui.fancytree.css" rel="stylesheet" type="text/css">
    <link href="/vendor/plugins/contextmenu/jquery.contextMenu.css" rel="stylesheet" type="text/css">
@stop

@section('js')
    <script src="/vendor/plugins/fancytree/jquery.fancytree-all-deps.js"></script>
    <script src="/vendor/plugins/fancytree/modules/jquery.fancytree.dnd.js"></script>
    <script src="/vendor/plugins/fancytree/modules/jquery.fancytree.persist.js"></script>
    <script src="/vendor/plugins/contextmenu/jquery.contextMenu-custom.js"></script>

    <script src="/vendor/plugins/custom-file-input/bs-custom-file-input.min.js"></script>

    <script src="/vendor/interfaces/interface.js" defer></script>
    <script src="/vendor/interfaces/interface_catalog.js" defer></script>
@stop
