<div class="chars">
    @foreach($product->chars as $char)
        <div class="row row-chars" data-id="{{ $char->id }} ">
            {!! Form::hidden('chars[id][]', $char->id) !!}
            <div style="width: 50px;" class="col-1">
                <i class="fa fa-ellipsis-v"></i>
                <i class="fa fa-ellipsis-v"></i>
            </div>
            <div class="col-5">
                {!! Form::text('chars[name][]',$char->name, ['class'=>'form-control', 'placeholder' => 'Название']) !!}
            </div>
            <div class="col-5">
                {!! Form::text('chars[value][]',$char->value, ['class'=>'form-control', 'placeholder' => 'Значение']) !!}
            </div>
            <div style="width: 150px;" class="col-1">
                <a href="{{ route('admin.catalog.product-delete-char', ['id' => $char->id]) }}"
                   onclick="delProductChar(this, event)" class="text-red">
                    <i class="fa fa-trash"></i> Удалить</a>
            </div>
        </div>
    @endforeach

    <div class="row hidden">
        {!! Form::hidden('chars[id][]', '') !!}
        <div style="width: 50px;" class="col-1">
            <i class="fa fa-ellipsis-v"></i>
            <i class="fa fa-ellipsis-v"></i>
        </div>
        <div class="col-5">
            {!! Form::text('chars[name][]','', ['class'=>'form-control', 'placeholder' => 'Название']) !!}
        </div>
        <div class="col-5">
            {!! Form::text('chars[value][]','', ['class'=>'form-control', 'placeholder' => 'Значение']) !!}
        </div>
        <div style="width: 150px;" class="col-1">
            <a href="#" onclick="delProductChar(this, event)" class="text-red">
                <i class="fa fa-trash"></i> Удалить</a>
        </div>
    </div>
</div>
<button class="btn btn-sm btn-info" onclick="addProductChar(this, event)">Добавить <i class="fa fa-plus-circle"></i></button>
<style>

</style>
