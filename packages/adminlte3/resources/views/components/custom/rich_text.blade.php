<div class="form-group">
    {{ Form::label($name, $label) }}
    {!! Form::textarea($name, $value, array_merge(['rows' => 10, 'cols' => 80, 'id' => $name], $attributes)) !!}
    <script defer>
        $({{ $name }}).summernote({
            height: {{ $height }}
        });
    </script>
</div>
