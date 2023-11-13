<div class="form-group" style="width:160px;">
    {{ Form::label($label ?: $name, null, ['class' => 'control-label']) }}
    {{ Form::date($name, $value, array_merge(['class' => 'form-control', 'id' => $name], $attributes)) }}
</div>
