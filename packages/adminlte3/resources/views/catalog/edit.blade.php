{!! Form::open(['route' => 'admin.catalog.save', 'onsubmit' => 'catalogSave(this, event)']) !!}
    {{ Form::hidden('id', $catalog->id) }}
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
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-three-tabContent">
                {{--param_tab--}}
                <div class="tab-pane fade show active" id="tabs-three-params" role="tabpanel" aria-labelledby="tab-param">
                    <div class="row">
                        {{ Form::groupText('name', $catalog->name, 'Название', [], 'col-6') }}
                        {{ Form::groupText('alias', $catalog->alias, 'Alias', [], 'col-6') }}
                    </div>
                        {{ Form::groupSelect('parent_id', array_merge([0 => 'Корневой раздел'], $catalogs_list), $catalog->parent_id, 'Родительская страница') }}

                    <div class="row">
                        <div class="col-6">
                            {{ Form::groupText('title', $catalog->title, 'Title') }}
                            {{ Form::groupText('description', $catalog->description, 'Description') }}
                            {{ Form::groupText('keywords', $catalog->keywords, 'Keywords') }}
                        </div>
                        <div class="col-6">
                            {{ Form::groupText('og_title', $catalog->og_title, 'OG Title') }}
                            {{ Form::groupText('og_description', $catalog->og_description, 'OG Description') }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label for="image">Изображение</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image" name="image"
                                           onchange="return catalogImageAttache(this, event)"
                                           accept=".png,.jpg,.jpeg">
                                    <label class="custom-file-label" for="image">Выберите файл</label>
                                </div>
                            </div>
                            <div id="catalog-image" class="mt-2">
                                @if ($catalog->image)
                                    <img class="img-polaroid" src="{{ $catalog->thumb(1) }}" height="100"
                                         data-image="{{ $catalog->image_src }}"
                                         onclick="popupImage($(this).data('image'))" alt="">
                                    <a class="image-delete" href="{{ route('admin.catalog.delete-image', [$catalog->id]) }}"
                                       onclick="deleteImage(this, event)">
                                        <i class="fa fa-trash text-red ml-2"></i>
                                    </a>
                                @else
                                    <p class="text-yellow">Изображение не загружено.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    {{ Form::groupBool('published', $catalog->published, 'Показывать страницу') }}
                </div>

                {{--text_tab--}}
                <div class="tab-pane fade" id="tabs-three-text" role="tabpanel" aria-labelledby="tab-text">
                    {{ Form::groupRichtext('text', $catalog->text, 'Текст', []) }}
                </div>

            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-save"></i> Сохранить
            </button>
        </div>
    </div>
{!! Form::close() !!}
