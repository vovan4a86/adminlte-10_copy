@extends('adminlte::page')

@section('title', 'Profile')

@section('content_header')
    <h1>Profile</h1>
@stop

@section('css')
{{--    <link rel="stylesheet" href="/css/admin_custom.css">--}}
@stop

@section('js')
    <script src="/js/interface.js"></script>
    <script src="/js/admin_user.js"></script>
@stop

@section('content')
    {{--    https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Forms-Components#input--}}
    @guest
        <p>User: {{ $username }}</p>
    @else
        <form action="{{ route('admin.user.save') }}" id="user_form">
            <x-adminlte-input name="id" type="hidden" value="{{ Auth::user()->id }}"></x-adminlte-input>
            <div class="row">
                <x-adminlte-input name="name" label="Name" placeholder="name here"
                                  value="{{ Auth::user()->name }}"
                                  fgroup-class="col-md-6" disable-feedback>
                </x-adminlte-input>
            </div>
            <div class="row">
                <x-adminlte-input name="email" type="email" placeholder="mail@example.com"
                                  value="{{ Auth::user()->email }}"
                                  fgroup-class="col-md-6" disable-feedback>
                    {{Auth::user()->email}}
                </x-adminlte-input>
            </div>
            <x-adminlte-button class="btn-flat" type="submit" label="Submit" theme="success" icon="fas fa-lg fa-save"></x-adminlte-button>
            <div id="answer"></div>
        </form>
    @endguest
@stop
