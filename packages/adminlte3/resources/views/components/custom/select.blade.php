<div class="form-group">
    {{ Form::label($name, $label) }}
    {!! Form::select($name, $list, $value, array_merge(['class' => 'form-control'], $attributes)) !!}
</div>
