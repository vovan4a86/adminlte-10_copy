<div class="row row-chars">
    {{ Form::hidden('chars[id][]', '') }}
    <div style="width: 17px">
        <i class="fa fa-ellipsis-v"></i>
        <i class="fa fa-ellipsis-v"></i>
    </div>
    <div class="col-10 d-flex">
        {!! Form::text('chars[name][]','', ['class'=>'form-control', 'placeholder' => 'Название']) !!}
        {!! Form::text('chars[value][]','', ['class'=>'form-control', 'placeholder' => 'Значение']) !!}
    </div>
    <div class="col-1">
        <a href="#" onclick="addProductChar(this, event)"><i class="fa fa-plus-circle"></i></a>
    </div>
</div>

<div class="chars">
    @foreach($product->chars as $param)
        <div class="row row-chars">
            {!! Form::hidden('chars[id][]', $param->id) !!}
            <div style="width: 17px">
                <i class="fa fa-ellipsis-v"></i>
                <i class="fa fa-ellipsis-v"></i>
            </div>
            <div class="col-10 d-flex">
            {!! Form::text('chars[name][]',$param->name, ['class'=>'form-control', 'placeholder' => 'Название']) !!}
            {!! Form::text('chars[value][]',$param->value, ['class'=>'form-control', 'placeholder' => 'Значение']) !!}
            </div>
            <div class="col-1">
                <a href="#" onclick="delProductChar(this, event)" class="text-red"><i class="fa fa-trash"></i></a>
            </div>
        </div>
    @endforeach
</div>

<style>
    .chars .row{
        margin: 10px;
    }
    .row-chars {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .row-chars input {
        margin-right: 15px;
    }
</style>
