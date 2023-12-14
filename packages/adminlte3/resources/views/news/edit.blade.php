@extends('adminlte::page')

@section('title', 'Новости')

@section('content_header')
    <div class="admin-page-head row">
        <div class="col-sm-3">
            <h5 class="admin-page-title">Новость <small style="font-style: italic;">{{ $article->id ? 'Редактировать' : 'Новая' }}</small>
            </h5>
        </div>
        <div class="col-sm-9">
            <ul class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.index') }}">Главная</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.news.index') }}">Новости</a>
                </li>
                <li class="breadcrumb-item active">{{ $article->id ? 'Редактировать' : 'Новая' }}</li>
            </ul>
        </div>
    </div>
@stop

@section('content')
    {!! Form::open(['route' => 'admin.news.save', 'onsubmit' => 'newsSave(this, event)']) !!}
    {{ Form::hidden('id', $article->id) }}
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
            <div class="tab-custom-content text-right">
                @if($article->id)
                    <a class="text-danger mr-2" href="{{ $article->url }}" target="_blank">Посмотреть</a>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-three-tabContent">
                {{--param_tab--}}
                <div class="tab-pane fade show active" id="tabs-three-params" role="tabpanel"
                     aria-labelledby="tab-param">

                    <div class="row">
                        <div class="tags">
                            @foreach($article->tags as $tag)
                                <span>{{ $tag->name }}</span>
                            @endforeach
                        </div>
                        <input type="text" name="tag">
                        <button class="btn btn-info"
                                data-url="{{ route('admin.news.add-tag', $article->id) }}"
                                onclick="addNewsTag(this, event)">
                            Добавить
                        </button>
                    </div>

                    {!! Form::groupDate('date', $article->date, 'Дата') !!}

                    {{ Form::groupSelect('news_category', array_merge([0 => 'Без категории'], $news_categories), $article->news_category, 'Категория') }}

                    <div class="row">
                        {{ Form::groupText('name', $article->name, 'Название', [], 'col-6') }}
                        {{ Form::groupText('alias', $article->alias, 'Alias', [], 'col-6') }}
                    </div>

                    <div class="row">
                        <div class="col-6">
                            {{ Form::groupText('title', $article->title, 'Title') }}
                            {{ Form::groupText('description', $article->description, 'Description') }}
                            {{ Form::groupText('keywords', $article->keywords, 'Keywords') }}
                        </div>
                        <div class="col-6">
                            {{ Form::groupText('og_title', $article->og_title, 'OG Title') }}
                            {{ Form::groupText('og_description', $article->og_description, 'OG Description') }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label for="image">Изображение</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file" id="image" name="image"
                                           onchange="newsImageAttache(this, event)"
                                           accept=".png,.jpg,.jpeg">
                                    <label class="custom-file-label" for="image">Выберите файл</label>
                                </div>
                            </div>
                            <div id="news-image" class="mt-2">
                                @if ($article->image)
                                    <img class="img-polaroid" src="{{ $article->thumb(1) }}" height="100"
                                         data-image="{{ $article->image_src }}"
                                         onclick="popupImage($(this).data('image'))" alt="">
                                    <a class="image-delete" href="{{ route('admin.pages.delete-image', [$article->id]) }}"
                                       onclick="deleteImage(this, event)">
                                        <i class="fa fa-trash text-red ml-2"></i>
                                    </a>
                                @else
                                    <p class="text-yellow">Изображение не загружено.</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{ Form::groupBool('published', $article->published, 'Показывать новость') }}
                </div>

                {{--text_tab--}}
                <div class="tab-pane fade" id="tabs-three-text" role="tabpanel" aria-labelledby="tab-text">
                    {{ Form::groupRichtext('announce', $article->announce, 'Анонс') }}
                    {{ Form::groupRichtext('text', $article->text, 'Текст') }}
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success btn-sm">
                <i class="fa fa-save"></i>
                Сохранить</button>
        </div>
    </div>
    {!! Form::close() !!}
@stop

@section('js')
    <script src="/vendor/interfaces/interface.js"></script>
    <script src="/vendor/interfaces/interface_news.js"></script>
@stop
