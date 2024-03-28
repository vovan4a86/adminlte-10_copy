@extends('adminlte::page')

@section('title', 'Структура сайта')

@section('content_header')
    <div class="admin-page-head row">
        <div class="col-sm-3">
            <h5 class="admin-page-title">Структура сайта</h5>
            <button class="toast-btn btn btn-sm btn-success">Toast</button>
            <button class="popup-btn btn btn-sm btn-success">Popup</button>
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
            </div>
        </div>

        <div id="page-content" class="col-md-9">
            @if(isset($page))
                @include('adminlte::pages.edit_new')
            @endif
        </div>
    </div>
@stop
