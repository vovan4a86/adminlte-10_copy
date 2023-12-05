<!DOCTYPE html>
<html lang="ru">

@include('blocks.head')

<body x-data="{ catalogIsOpen: false }">

@if(!SiteHelper::isGooglePageSpeed())
    {!! Settings::get('counters') !!}
@endif

@include('blocks.header')
@yield('content')
@include('blocks.footer')
@include('blocks.mobile_nav')
@include('blocks.popups')

<div class="v-hidden" id="company" itemprop="branchOf" itemscope
     itemtype="https://schema.org/Corporation" aria-hidden="true" tabindex="-1">
    {!! Settings::get('schema.org') !!}
</div>
<div class="scrolltop" aria-label="В начало страницы" tabindex="1">
    <svg class="svg-sprite-icon icon-up">
        <use xlink:href="/static/images/sprite/symbol/sprite.svg#up"></use>
    </svg>
</div>

@if(isset($admin_edit_link) && strlen($admin_edit_link))
    <div class="adminedit">
        <div class="adminedit__ico"></div>
        <a href="{{ $admin_edit_link }}" class="adminedit__name" target="_blank">Редактировать</a>
    </div>
@endif
</body>
</html>
