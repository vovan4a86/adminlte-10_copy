@extends('adminlte::page')

@section('title', 'Profile')

@section('content_header')
    <h1>Редактировать <b>{{ $user->name }}</b></h1>
@stop

@section('css')
@stop

@section('js')
    <script src="/js/interface.js"></script>
    <script src="/js/admin_user.js"></script>
@stop

@section('content')
    <form action="{{ route('admin.user.save') }}" id="user_form">
        <x-adminlte-input name="id" type="hidden" value="{{ $user->id }}"></x-adminlte-input>
        <div class="row">
            <x-adminlte-input name="name" label="Имя" placeholder="name here"
                              value="{{ $user->name }}"
                              fgroup-class="col-md-6" disable-feedback>
            </x-adminlte-input>
        </div>
        <div class="row">
            <x-adminlte-input name="email" type="email" placeholder="mail@example.com"
                              label="Email"
                              value="{{ $user->email }}"
                              fgroup-class="col-md-6" disable-feedback>
                {{ $user->email }}
            </x-adminlte-input>
        </div>
        <div class="row">
            <x-adminlte-select name="is_admin" label="Администратор?"
                               fgroup-class="col-md-6" disable-feedback>
                @foreach(['Нет', 'Да'] as $elem)
                    <option value="{{ $loop->index }}" {{ $user->is_admin == $loop->index ? 'selected' : '' }}>
                        {{ $elem }}
                    </option>
                @endforeach
            </x-adminlte-select>
        </div>
        <div class="row">
            <input type="password" class="form-control" id="inputPassword3" placeholder="Password" {{ $user->password }}>
        </div>

        <x-adminlte-button class="btn-flat" type="submit" label="Submit" theme="success"
                           icon="fas fa-lg fa-save"></x-adminlte-button>
        <div id="answer"></div>
    </form>
@stop
