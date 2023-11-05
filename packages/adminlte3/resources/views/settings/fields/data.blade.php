<div class="form-group">
	<dl class="dl-horizontal s-dl">
		@foreach (Arr::get($setting->params, 'fields', []) as $field => $params)
			<dt>{{ Arr::get($params, 'title') }}</dt>
			<dd>
				@if ($params['type'] == 0)
					@include('adminlte::settings.fields.input', ['name' => "setting[".$setting->id."][$field]", 'value' => Arr::get($setting->value, $field, ''), 'placeholder' => Arr::get($params, 'title')])
				@elseif ($params['type'] == 1)
					@include('adminlte::settings.fields.textarea', ['name' => "setting[".$setting->id."][$field]", 'value' => Arr::get($setting->value, $field, ''), 'placeholder' => Arr::get($params, 'title')])
				@elseif ($params['type'] == 2)
					@include('adminlte::settings.fields.editor', ['id' => 'setting_'.$setting->id.'_'.$field, 'name' => "setting[".$setting->id."][$field]", 'value' => Arr::get($setting->value, $field, '')])
				@elseif ($params['type'] == 3)
					@include('adminlte::settings.fields.file', ['setting' => $setting, 'name' => "setting[".$setting->id."][$field]", 'value' => Arr::get($setting->value, $field, ''), 'placeholder' => Arr::get($params, 'title')])
				@endif
			</dd>
		@endforeach
	</dl>
</div>
