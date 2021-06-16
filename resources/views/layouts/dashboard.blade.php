<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="#">
    <meta name="keywords" content="{{ config('app.name') }}">
    <title>{{ config('app.name') }}</title>
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" href="/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="/css/app.css" />
    @livewireStyles
</head>
<body class="main">
    @yield('content')

    @livewireScripts
    <script src="/js/app.js"></script>
    @stack('scripts')
</body>
</html>
