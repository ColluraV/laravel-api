<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->


@vite(['resources/js/app.js'])
</head>

<body class=" chip-bg">
    <div class="sl-bg"></div>
    <div class="sl-bg sl-bg2"></div>
    <div class="sl-bg sl-bg3"></div>
    <div class="content">

        @if (Route::has('login'))
            <div class="">
                @auth
                    <a href="{{ url('/home') }}"
                        class="">Dashboard</a>
                @else
                    <a href="{{ route('login') }}"
                        class="">Log
                        in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="">Register</a>
                    @endif
                @endauth
            </div>
        @endif

        <div class="container">
            <div class="row">

                <div class="col">        
                    


                    <h1 style="font-size:2rem">Benvenuto Viaggiatore</h1>
                    
                    <a class="btn btn-light" href="/projects"> Progetti</a>

                </div>

            </div>
        </div>

    </div>
</body>

</html>
