@extends('adminlte::page')

@section('title', 'Profile')

@section('content_header')
    <h1>Пользователи</h1>
@stop

@section('css')
@stop

@section('js')
    <script src="/js/interface.js"></script>
    <script src="/js/admin_user.js"></script>
@stop

@section('content')
    @if(count($users))
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Имя</th>
                <th scope="col">Email</th>
                <th scope="col">Администратор</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->is_admin ? 'Да' : 'Нет' }}</td>
                    <td>
                        <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Редактировать">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </a>
                        <a href="{{ route('admin.user.delete', $user->id) }}" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Удалить">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>Нет ни одного пользователя!</p>
    @endif
@stop
