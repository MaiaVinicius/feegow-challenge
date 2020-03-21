<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Controle de campeonatos">
        <meta name="author" content="Isaias Santos">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="{{ asset('images/feegow_logo.png') }}">
        <title>{{ config('app.name') }}</title>
        <!-- Bootstrap core-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="css/styles.css">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <script src="js/scripts.js"></script>
        <script src="js/bootstrap-notify.min.js"></script>
        <script src="js/maskedinput.js"></script>
    </head>
    <body class="fixed-nav sticky-footer" id="page-top">
    @if(Session::has('message'))
        <script>
            $.notify({ message: "{{ Session::get('message') }}" }, { type: 'success' });
        </script>
    @endif
    @if ($errors->any())
        @foreach ($errors->all() as $error)
        <script>
            $.notify({ message: "{{ $error }}" }, { type: 'warning' });
        </script>
        @endforeach
    @endif
        <div class='row'>
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <nav class="navbar navbar-dark bg-dark">
                    <a class="navbar-brand" href="#">{{ config('app.name') }}</a>
                </nav>
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </body>
    
    <script>
        var public_path = "{{asset('/')}}";
    </script>

    @yield('scripts')
</html>