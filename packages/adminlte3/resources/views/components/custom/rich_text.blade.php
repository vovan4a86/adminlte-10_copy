<div class="form-group">
    {{ Form::label($name, $label) }}
    {!! Form::textarea($name, $value, array_merge(['id' => $name, 'class' => 'summernote'], $attributes)) !!}
</div>
