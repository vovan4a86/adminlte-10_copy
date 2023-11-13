<li class="{{ $active->id == $group->id ? 'active' : '' }}">
    <span class="handle ui-sortable-handle">
    <i class="fas fa-ellipsis-v"></i>
    <i class="fas fa-ellipsis-v"></i>
    </span>
    <span class="text">
        <a class="" href="{{ route('admin.settings.groupItems', [$group->id]) }}">{{ $group->name }}</a>
        <form action="{{ route('admin.settings.groupSave') }}" onsubmit="return settingsGroupSave(this)"
                  style="display:none;">
				<input type="hidden" name="id" value="{{ $group->id }}">
				<div class="input-group input-group-sm">
					<input type="text" class="form-control" name="name" value="{{ $group->name }}"
                           placeholder="Название галереи...">
					<span class="input-group-btn">
						<button class="btn btn-success btn-flat" type="submit"><span
                                class="fa fa-check"></span></button>
					</span>
				</div>
        </form>
    </span>
    <div class="tools">
        <a href="#" onclick="return settingsGroupEdit(this)"><i class="text-red fas fa-edit"></i></a>
        <a href="#" data-url="{{ route('admin.settings.groupDelete', [$group->id]) }}"
           onclick="return settingsGroupDel(this)"><i class="text-red fa fa-trash"></i></a>
    </div>
</li>
