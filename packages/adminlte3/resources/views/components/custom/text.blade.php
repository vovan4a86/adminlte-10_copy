<div class="form-group {{ $col }}">
    {{ Form::label($name, $label) }}
    {{ Form::text($name, $value, array_merge(['class' => 'form-control', 'id' => $name], $attributes)) }}
</div>
