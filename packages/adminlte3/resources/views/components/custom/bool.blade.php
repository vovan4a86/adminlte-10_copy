<div class="form-group">
    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
        <input type="checkbox" class="custom-control-input" id="{{ $name }}" name="{{ $name }}"
            {{ $value == '1' ? 'checked' : null }}>
{{--        {{ Form::checkbox($name, $value, 1, $attributes = ['class' => 'custom-control-input']) }}--}}
        <label class="custom-control-label" for="{{ $name }}">{{ $label }}</label>
    </div>
</div>
