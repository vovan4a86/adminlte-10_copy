@foreach ($settings as $setting)
	<div class="setting-item" data-id="{{ $setting->id }}">
		<div class="form-group">
			<div style="display: flex; justify-content: space-between">
				<label>{{ $setting->name }}</label>
				<a class="popup-ajax pull-right" href="{{ route('admin.settings.edit', [$setting->id]) }}">редактировать</a>
			</div>

			@if ($setting->type == 0)
				@include('adminlte::settings.fields.input', ['setting' => $setting])
			@elseif ($setting->type == 1)
				@include('adminlte::settings.fields.textarea', ['setting' => $setting])
			@elseif ($setting->type == 2)
				@include('adminlte::settings.fields.editor', ['setting' => $setting])
			@elseif ($setting->type == 3)
				@include('adminlte::settings.fields.file', ['setting' => $setting])
			@elseif ($setting->type == 4)
				@include('adminlte::settings.fields.data', ['setting' => $setting])
			@elseif ($setting->type == 5)
				@include('adminlte::settings.fields.list', ['setting' => $setting])
			@elseif ($setting->type == 6)
				@include('adminlte::settings.fields.list_data', ['setting' => $setting])
			@elseif ($setting->type == 7)
				@include('adminlte::settings.fields.gallery', ['setting' => $setting])
			@endif

			@if ($setting->description)
				<p class="help-block">{{ $setting->description }}</p>
			@endif
		</div>
	</div>
@endforeach
