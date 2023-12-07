<head>
    <meta charset="utf-8">
    {!! SEOMeta::generate() !!}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <!-- place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="/img/icon/favicon.png">
    <!-- Google Font css -->
    <link href="https://fonts.googleapis.com/css?family=Lily+Script+One" rel="stylesheet">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="AdminLte3 Test">
    <meta property="og:image" content="/img/icon/favicon.png">

    {!! OpenGraph::generate() !!}
    <script src="/js/vendor/modernizr-2.8.3.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
