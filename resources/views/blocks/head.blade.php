<head>
    <meta charset="utf-8">
    {!! SEOMeta::generate() !!}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="/static/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/static/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/static/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="/static/images/favicon/site.webmanifest">
    <link rel="mask-icon" href="/static/images/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="/static/images/favicon/favicon.ico">
    <meta name="apple-mobile-web-app-title" content="name">
    <meta name="application-name" content="name">
    <meta name="cmsmagazine" content="18db2cabdd3bf9ea4cbca88401295164">
    <meta name="author" content="Fanky.ru">
    <meta name="msapplication-TileColor" content="#00aba9">
    <meta name="msapplication-config" content="/static/images/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <meta property="og:type" content="profile">
    <meta property="og:image" content="/static/images/favicon/apple-touch-icon.png">
    {!! OpenGraph::generate() !!}


    @if(Route::is('main'))
    <!-- if homepage, preload two image bg's, on blocks: hero__way-->
    <link rel="preload" fetchpriority="low" as="image" href="/static/images/common/hero-bg-1.webp" type="image/webp">
    <link rel="preload" fetchpriority="low" as="image" href="/static/images/common/hero-bg-2.webp" type="image/webp">
    <!-- endif-->
    @endif

    <link href="/static/fonts/Manrope-Light.woff2" rel="preload" as="font" type="font/woff2" crossorigin="anonymous">
    <link href="/static/fonts/Manrope-Regular.woff2" rel="preload" as="font" type="font/woff2" crossorigin="anonymous">
    <link href="/static/fonts/Manrope-Medium.woff2" rel="preload" as="font" type="font/woff2" crossorigin="anonymous">
    <link href="/static/fonts/Manrope-SemiBold.woff2" rel="preload" as="font" type="font/woff2" crossorigin="anonymous">
    <link href="/static/fonts/Manrope-Bold.woff2" rel="preload" as="font" type="font/woff2" crossorigin="anonymous">

    @if(Route::is('contacts'))
        <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" defer></script>
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
