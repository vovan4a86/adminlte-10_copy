<div class="form-group">
    {{ Form::label($name, null) }}
    {!! Form::textarea($name, $value, array_merge(['rows' => 10, 'cols' => 80, 'id' => $name], $attributes)) !!}
    <script type="text/javascript">
        $({{ $name }}).summernote({
            height: {{ $height }}
        });
    </script>
</div>
