<form action="{{ route('admin.settings.save') }}" method="post" enctype="multipart/form-data" onsubmit="settingsSave(this, event)">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<input type="hidden" name="group_id" value="{{ $group->id }}">

	<div class="box box-solid">
		<div class="box-header">
			<h5 class="box-title">
				{{ $group->name }}
			</h5>
		</div>

		<div class="box-body">
			@if ($group->description)
				<p class="lead">{{ $group->description }}</p>
			@endif

			<a class="margin popup-ajax btn btn-sm btn-info" href="{{ route('admin.settings.edit').'?group='.$group->id }}">Добавить настройку <i class="fa fa-plus"></i></a>
			<div id="settings-group-{{ $group->id }}">
				@include('adminlte::settings.items', ['settings' => $settings])
			</div>
		</div>

		<div class="box-footer">
			<button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Сохранить</button>
		</div>
	</div>
</form>

{{--<script type="text/javascript"> $('.setting-items-list').sortable({handle: '.handle'}); </script>--}}
{{--<script type="text/javascript"> $('.setting-gal-list').sortable({handle: '.images_move'}); </script>--}}
