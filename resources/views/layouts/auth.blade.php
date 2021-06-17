<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="#">
    <meta name="keywords" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" href="/images/logo.svg" type="image/x-icon">
    <link rel="stylesheet" href="/css/app.css" />
    <script type="text/javascript">
        function callbackThen(response){
            // read HTTP status
            console.log(response.status);

            // read Promise object
            response.json().then(function(data){
                console.log(data);
            });
        }
        function callbackCatch(error){
            console.error('Error:', error)
        }
    </script>
    {!! htmlScriptTagJsApi([
        'action' => 'homepage',
        'callback_then' => 'callbackThen',
        'callback_catch' => 'callbackCatch'
    ]) !!}
    @livewireStyles
</head>
<body class="login">
    <div class="container sm:px-10">
        @yield('content')
    </div>

    @livewireScripts
    <script src="/js/app.js"></script>
    @stack('scripts')
</body>
</html>
