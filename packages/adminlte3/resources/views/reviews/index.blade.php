@extends('adminlte::page')

@section('title', 'Отзывы')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h3>Отзывы <a href="{{ route('admin.reviews.edit') }}" class="btn btn-sm btn-info">
                    Добавить отзыв <i class="fa fa-plus"></i></a>
            </h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.index') }}">Главная</a>
                </li>
                <li class="breadcrumb-item active">Отзывы</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        @if (count($reviews))
            <div class="card-body table-responsive p-0">
                <table class="table table-striped table-v-middle">
                    <tbody id="reviews-list">
                    @foreach ($reviews as $item)
                        <tr data-id="{{ $item->id }}">
                            <td style="width: 60px">
                                <i class="fa fa-ellipsis-v"></i>
                                <i class="fa fa-ellipsis-v"></i>
                            </td>
                            <td style="width: 200px">{{ $item->name }}</td>
                            <td>{!! $item->text !!}</td>
                            <td style="width: 40px;"><a class="fa fa-edit"
                                   href="{{ route('admin.reviews.edit', [$item->id]) }}"
                                   style="font-size:20px; color:orange;"></a></td>
                            <td style="width: 40px;">
                                <a class="fa fa-trash"
                                   href="{{ route('admin.reviews.delete', [$item->id]) }}"
                                   style="font-size:20px; color:red;" onclick="reviewDelete(this, event)"></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="m-3">Нет отзывов!</p>
        @endif
    </div>
@stop

@section('js')
    <script src="/vendor/interfaces/interface.js"></script>
    <script src="/vendor/interfaces/interface_reviews.js"></script>
    <script type="text/javascript">
        $("#reviews-list").sortable({
            update: function (event, ui) {
                let url = "{{ route('admin.reviews.reorder') }}";
                let data = {};
                data.sorted = ui.item.closest('#reviews-list').sortable("toArray", {attribute: 'data-id'});
                sendAjax(url, data);
            }
        }).disableSelection();
    </script>
@stop
