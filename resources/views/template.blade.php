<!DOCTYPE html>
<html lang="ru">

@include('blocks.head')

<body>

@if(!SiteHelper::isGooglePageSpeed())
    {!! Settings::get('counters') !!}
@endif
<div class="wrapper homepage">

    @if(Route::is('main'))
        <div class="popup_wrapper">
        <div class="test">
            <span class="popup_off">Закрыть</span>
            <div class="subscribe_area text-center mt-60">
                <h2>Рассылка новостей</h2>
                <p>Подпишитесь на рассылку Jantrik, чтобы получать информацию о новых поступлениях, специальных предложениях и других скидках</p>
                <div class="subscribe-form-group">
                    <form action="#">
                        <input autocomplete="off" type="text" name="message" id="message" placeholder="Enter your email address">
                        <button type="submit">Подписаться</button>
                    </form>
                </div>
                <div class="subscribe-bottom mt-15">
                    <input type="checkbox" id="newsletter-permission">
                    <label for="newsletter-permission">Больше не показывайте это всплывающее окно</label>
                </div>
            </div>
        </div>
    </div>
    @endif

    @include('blocks.header')

    @yield('content')

    @include('blocks.footer')
</div>

<div class="v-hidden" id="company" itemprop="branchOf" itemscope
     itemtype="https://schema.org/Corporation" aria-hidden="true" tabindex="-1">
    {!! Settings::get('schema.org') !!}
</div>

@if(isset($admin_edit_link) && strlen($admin_edit_link))
    <div class="adminedit">
        <div class="adminedit__ico"></div>
        <a href="{{ $admin_edit_link }}" class="adminedit__name" target="_blank">Редактировать</a>
    </div>
@endif

<script src="/js/vendor/jquery-1.12.4.min.js"></script>
<!-- mobile menu js  -->
<script src="/js/jquery.meanmenu.min.js"></script>
<!-- scroll-up js -->
<script src="/js/jquery.scrollUp.js"></script>
<!-- owl-carousel js -->
<script src="/js/owl.carousel.min.js"></script>
<!-- slick js -->
<script src="/js/slick.min.js"></script>
<!-- wow js -->
<script src="/js/wow.min.js"></script>
<!-- price slider js -->
<script src="/js/jquery-ui.min.js"></script>
<script src="/js/jquery.countdown.min.js"></script>
<!-- nivo slider js -->
<script src="/js/jquery.nivo.slider.js"></script>
<!-- fancybox js -->
<script src="/js/jquery.fancybox.min.js"></script>
<!-- bootstrap -->
<script src="/js/bootstrap.min.js"></script>
<!-- popper -->
<script src="/js/popper.js"></script>
<!-- plugins -->
<script src="/js/plugins.js"></script>
<!-- main js -->
<script src="/js/main.js"></script>
</body>
</html>
