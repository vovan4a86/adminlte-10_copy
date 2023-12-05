@foreach ($settings as $setting)
    <div class="card card-{{ ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'dark'][$setting->type] }} setting-item" data-id="{{ $setting->id }}">
        <div class="card-header">
            <h4 class="card-title w-100 d-flex justify-content-between">
                <a class="d-block w-100" data-toggle="collapse" href="#collapse_{{ $setting->id }}">
                    {{ $setting->name }}
                </a>
                <a class="popup-ajax pull-right" href="{{ route('admin.settings.edit', [$setting->id]) }}"><i class="fa fa-edit"></i></a>
            </h4>
        </div>
        <div id="collapse_{{ $setting->id }}" class="collapse" data-parent="#settings-group">
            <div class="card-body">
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
    </div>

{{--    <div class="setting-item" data-id="{{ $setting->id }}">--}}
{{--		<div class="form-group">--}}
{{--			<div style="display: flex; justify-content: space-between" class="mt-1 mb-2">--}}
{{--				<label>{{ $setting->name }}</label>--}}
{{--				<a class="popup-ajax pull-right" href="{{ route('admin.settings.edit', [$setting->id]) }}">редактировать <i class="fa fa-edit"></i></a>--}}
{{--			</div>--}}

{{--			@if ($setting->type == 0)--}}
{{--				@include('adminlte::settings.fields.input', ['setting' => $setting])--}}
{{--			@elseif ($setting->type == 1)--}}
{{--				@include('adminlte::settings.fields.textarea', ['setting' => $setting])--}}
{{--			@elseif ($setting->type == 2)--}}
{{--				@include('adminlte::settings.fields.editor', ['setting' => $setting])--}}
{{--			@elseif ($setting->type == 3)--}}
{{--				@include('adminlte::settings.fields.file', ['setting' => $setting])--}}
{{--			@elseif ($setting->type == 4)--}}
{{--				@include('adminlte::settings.fields.data', ['setting' => $setting])--}}
{{--			@elseif ($setting->type == 5)--}}
{{--				@include('adminlte::settings.fields.list', ['setting' => $setting])--}}
{{--			@elseif ($setting->type == 6)--}}
{{--				@include('adminlte::settings.fields.list_data', ['setting' => $setting])--}}
{{--			@elseif ($setting->type == 7)--}}
{{--				@include('adminlte::settings.fields.gallery', ['setting' => $setting])--}}
{{--			@endif--}}

{{--			@if ($setting->description)--}}
{{--				<p class="help-block">{{ $setting->description }}</p>--}}
{{--			@endif--}}
{{--		</div>--}}
{{--	</div>--}}
@endforeach
