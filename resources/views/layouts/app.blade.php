<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @hasSection ('title')
     @yield('title')
    @endif
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        html, body {
            background: url("{{asset('imgs/fundo.jpg')}}");
        }
    </style>
    @hasSection('style')
        @yield('style')
    @endif

</head>
<body>
    @component('component_navbar', ["current" => $current])
    @endcomponent
    <div class="container">
        <main class="py-4" role="main" >
            @hasSection('body')
                @yield('body')
            @endif
        </main>
    </div>

    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>

    @hasSection ('javascript')
        @yield('javascript')
    @endif
    <div class="footer">
        <div style="text-align: center;">
            <a href="#" style="color: black;"><strong>Termos de Uso e Serviços</strong></a>
        </div>
    </div>
</body>
</html>
