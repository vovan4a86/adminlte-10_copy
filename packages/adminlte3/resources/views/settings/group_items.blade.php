<form action="{{ route('admin.settings.save') }}" method="post" enctype="multipart/form-data" onsubmit="settingsSave(this, event)">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<input type="hidden" name="group_id" value="{{ $group->id }}">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $group->name }}</h3>

        </div>
        @if ($group->description)
            <p class="lead">{{ $group->description }}</p>
        @endif

        <div class="d-inline-block ml-3 my-2">
            <a class="margin popup-ajax btn btn-sm btn-info" href="{{ route('admin.settings.edit').'?group='.$group->id }}">
                Добавить настройку <i class="fa fa-plus ml-1"></i>
            </a>
        </div>

        <div class="card-body">
            <div id="settings-group" class="accordion">
                @include('adminlte::settings.items', ['settings' => $settings])
            </div>
        </div>
    </div>

{{--	<div class="box box-solid">--}}
{{--		<div class="box-header">--}}
{{--			<h5 class="box-title">--}}
{{--				{{ $group->name }}--}}
{{--			</h5>--}}
{{--		</div>--}}

{{--		<div class="box-body">--}}
{{--			@if ($group->description)--}}
{{--				<p class="lead">{{ $group->description }}</p>--}}
{{--			@endif--}}

{{--			<a class="margin popup-ajax btn btn-sm btn-info" href="{{ route('admin.settings.edit').'?group='.$group->id }}">Добавить настройку <i class="fa fa-plus"></i></a>--}}
{{--			<div id="settings-group-{{ $group->id }}">--}}
{{--				@include('adminlte::settings.items', ['settings' => $settings])--}}
{{--			</div>--}}
{{--		</div>--}}

{{--		<div class="box-footer">--}}
{{--			<button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Сохранить</button>--}}
{{--		</div>--}}
{{--	</div>--}}
</form>

{{--<script type="text/javascript"> $('.setting-items-list').sortable({handle: '.handle'}); </script>--}}
{{--<script type="text/javascript"> $('.setting-gal-list').sortable({handle: '.images_move'}); </script>--}}
