{!! Form::open(['route' => 'admin.pages.save', 'onsubmit' => 'pageSave(this, event)']) !!}
    {{ Form::hidden('id', $page->id) }}
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
                        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false" class="nav-link dropdown-toggle">Настройки</a>
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
            <div class="tab-custom-content text-right">
                @if($page->id)
                    <a class="text-danger mr-2" href="{{ $page->url }}" target="_blank">Посмотреть</a>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-three-tabContent">
                {{--param_tab--}}
                <div class="tab-pane fade show active" id="tabs-three-params" role="tabpanel"
                     aria-labelledby="tab-param">
                    <div class="row">
                        {{ Form::groupText('name', $page->name, 'Название', [], 'col-6') }}
                        {{ Form::groupText('alias', $page->alias, 'Alias', [$page->system ? 'disabled' : null], 'col-6') }}
                    </div>
                    @if($page->id == 1)
                        {{ Form::hidden('parent_id', 0) }}
                    @else
                        {{ Form::groupSelect('parent_id', $pages_list, $page->parent_id, 'Родительская страница') }}
                    @endif

                    <div class="row">
                        <div class="col-6">
                            {{ Form::groupText('title', $page->title, 'Title') }}
                            {{ Form::groupText('description', $page->description, 'Description') }}
                            {{ Form::groupText('keywords', $page->keywords, 'Keywords') }}
                        </div>
                        <div class="col-6">
                            {{ Form::groupText('og_title', $page->og_title, 'OG Title') }}
                            {{ Form::groupText('og_description', $page->og_description, 'OG Description') }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label for="image">Изображение</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file" id="image" name="image"
                                           onchange="pageImageAttache(this, event)"
                                           accept=".png,.jpg,.jpeg">
                                    <label class="custom-file-label" for="image">Выберите файл</label>
                                </div>
                            </div>
                            <div id="page-image" class="mt-2">
                                @if ($page->image)
                                    <img class="img-polaroid" src="{{ $page->thumb(1) }}" height="100"
                                         data-image="{{ $page->image_src }}"
                                         onclick="popupImage($(this).data('image'))" alt="">
                                    <a class="image-delete" href="{{ route('admin.pages.delete-image', [$page->id]) }}"
                                       onclick="deleteImage(this, event)">
                                        <i class="fa fa-trash text-red ml-2"></i>
                                    </a>
                                @else
                                    <p class="text-yellow">Изображение не загружено.</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if($page->id !== 1)
                        {{ Form::groupBool('published', $page->published, 'Показывать страницу') }}
                        {{ Form::groupBool('on_header', $page->on_header, 'Показывать в шапке') }}
                        {{ Form::groupBool('on_footer', $page->on_footer, 'Показывать в подвале') }}
                        {{ Form::groupBool('on_mobile', $page->on_mobile, 'Показывать на мобильном') }}
                    @endif
                </div>

                {{--text_tab--}}
                <div class="tab-pane fade" id="tabs-three-text" role="tabpanel" aria-labelledby="tab-text">
                    {{ Form::groupRichtext('text', $page->text, 'Текст') }}
                </div>

                {{--settings_tabs--}}
                @foreach ($setting_groups as $item)
                    <div class="tab-pane fade" id="tab_setting_{{ $item->id }}" role="tabpanel"
                         aria-labelledby="aria_tab_setting_{{ $item->id }}">
                        <h4>{{ $item->name }}</h4>
                        @if ($item->description)
                            <blockquote><small>{{ $item->description }}</small></blockquote>
                        @endif

                        <input type="hidden" name="setting_group[]" value="{{ $item->id }}">

                        <a class="margin popup-ajax" href="{{ route('admin.settings.edit').'?group='.$item->id }}">Добавить
                            настройку <i class="fa fa-plus-circle"></i></a>
                        <div id="settings-group-{{ $item->id }}">
                            @include('adminlte::settings.items', ['settings' => $item->settings()->orderBy('order')->get()])
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-save"></i>
                Сохранить</button>
        </div>
    </div>
{!! Form::close() !!}
