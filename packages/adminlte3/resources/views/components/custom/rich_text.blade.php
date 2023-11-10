<div class="form-group">
    {{ Form::label($name, $label) }}
    {!! Form::textarea($name, $value, array_merge(['id' => $name], $attributes)) !!}
    <script defer>
        $({{ $name }}).summernote({
            height: {{ $height ?? 200 }}
        });
    </script>
</div>
