<form action="{{ route('admin.pages.save') }}" onsubmit="return pageSave(this, event)">
    <input id="page-id" type="hidden" name="id" value="{{ $page->id }}">
    <div class="card card-primary card-outline card-tabs">
        <div class="card-header p-0 pt-1 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tab-param"
                       data-toggle="pill" href="#tabs-three-params" role="tab"
                       aria-controls="custom-tabs-three-home" aria-selected="true">Параметры</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-text"
                       data-toggle="pill" href="#tabs-three-text" role="tab"
                       aria-controls="custom-tabs-three-profile" aria-selected="false">Текст</a>
                </li>
                @if (count($setting_groups))
                    <li class="nav-item dropdown">
                        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Настройки</a>
                        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                            @foreach ($setting_groups as $item)
                                <li><a href="#tab_setting_{{ $item->id }}" role="tab"
                                       id="aria_tab_setting_{{ $item->id }}" data-toggle="pill"
                                       aria-controls="custom-tabs-setting-{{ $item->id }}" aria-selected="false"
                                       class="nav-link dropdown-item">{{ $item->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-three-tabContent">
                {{--param_tab--}}
                <div class="tab-pane fade show active" id="tabs-three-params" role="tabpanel" aria-labelledby="tab-param">
                    <input type="hidden" name="parent_id" value="{{ $page->parent_id }}">
                    <div class="form-group">
                        <label>Название</label>
                        <input type="text" class="form-control" name="name" value="{{ $page->name }}"
                               placeholder="Название">
                    </div>
                    <div class="form-group">
                        <label>Alias</label>
                        <input type="text" class="form-control" name="alias" value="{{ $page->alias }}"
                               placeholder="Alias">
                    </div>
                    <div class="form-group">
                        <label for="image">Изображение</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image"
                                       accept=".png,.jpg,.jpeg">
                                <label class="custom-file-label" for="image">Выберите файл</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Загрузить</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                            <input type="checkbox" class="custom-control-input" id="published" name="published"
                                {{ $page->published ? 'checked' : '' }}>
                            <label class="custom-control-label" for="published">Показывать страницу</label>
                        </div>
                    </div>
                </div>

                {{--text_tab--}}
                <div class="tab-pane fade" id="tabs-three-text" role="tabpanel" aria-labelledby="tab-text">
                    <div class="form-group">
                        <label for="summernote">Текст</label>
                        <textarea id="summernote" name="text">{{ $page->text }}</textarea>
                    </div>
                </div>

                {{--settings_tabs--}}
                @foreach ($setting_groups as $item)
                    <div class="tab-pane fade" id="tab_setting_{{ $item->id }}" role="tabpanel" aria-labelledby="aria_tab_setting_{{ $item->id }}">
                        <h4>{{ $item->name }}</h4>
                        @if ($item->description)
                            <blockquote><small>{{ $item->description }}</small></blockquote>
                        @endif

                        <input type="hidden" name="setting_group[]" value="{{ $item->id }}">

                        <a class="margin popup-ajax" href="{{ route('admin.settings.edit').'?group='.$item->id }}">Добавить настройку</a>
                        <div id="settings-group-{{ $item->id }}">
                            @include('admin.settings.items', ['settings' => $item->settings()->orderBy('order')->get()])
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </div>
</form>
{{--<script>--}}
{{--    $(document).ready(function() {--}}
{{--        $('#summernote').summernote({--}}
{{--            height: 200--}}
{{--        });--}}
{{--        bsCustomFileInput.init();--}}
{{--    });--}}
{{--</script>--}}
