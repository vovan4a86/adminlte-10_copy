@extends('adminlte::page')

@section('title', 'Пользователи')

@section('content_header')
    <h3>Пользователи</h3>
@stop

@section('content')
    @if(count($users))
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Имя</th>
                <th scope="col">Email</th>
                <th scope="col">Статус</th>
                <th scope="col">Создан</th>
                <th scope="col">Активность</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->is_admin)
                            <span class="badge badge-success">Администратор</span>
                        @else
                            <span class="badge badge-danger">Пользователь</span>
                        @endif
                    </td>
                    <td>{{ $user->id == 1 ? '' : $user->created_at }}</td>
                    <td>
                        @if($user->is_active)
                            <i class="fa fa-check text-green"></i>
                        @else
                            <i class="fa fa-times text-red"></i>
                        @endif
                    </td>
                    <td>
                        @if($user->id != 1)
                            <a href="{{ route('admin.user.edit', $user->id) }}"
                               class="btn btn-xs btn-default text-primary mx-1 shadow" title="Редактировать">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </a>
                            <a href="{{ route('admin.user.delete', $user->id) }}" onclick="userDelete(this, event)"
                               class="btn btn-xs btn-default text-danger mx-1 shadow" title="Удалить">
                                <i class="fa fa-lg fa-fw fa-trash"></i>
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>Нет ни одного пользователя!</p>
    @endif
@stop

@section('js')
    <script src="/vendor/interfaces/interface.js"></script>
    <script src="/vendor/interfaces/interface_users.js"></script>
@stop
