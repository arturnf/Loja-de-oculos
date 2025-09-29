<!DOCTYPE html>
<html lang="pt-BR" translate="no">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="{{ asset('favicon.PNG') }}" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('title')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v=3">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="precnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body>

    <div class="container-menu close">
        <div class="nav-menu">
            <div class="logo logo-menu">
                <div class="logo-tx">
                    <h1 class="l">L</h1>
                    <h1 class="s">S</h1>
                </div>
            </div>

            <a class="hidden animate__animated" href="{{ route('home') }}">Coleções</a>
            <a class="hidden animate__animated" href="{{ route('loja', ['id' => 1]) }}">Loja</a>
            <a class="hidden animate__animated" href="{{ route('contato') }}">Contato</a>
            <a class="hidden animate__animated" href="{{ route('sobre') }}">Sobre</a>
        </div>
        <div class="x-menu">
            <i class="fa-solid fa-xmark"></i>
        </div>
    </div>


    <header>
        <div class="main-header">
            <div class="nav hidden animate__animated">
                <a href="{{ route('home') }}">Coleções</a>
                <a href="{{ route('loja', ['id' => 1]) }}">Loja</a>
                <a href="{{ route('contato') }}">Contato</a>
                <a href="{{ route('sobre') }}">Sobre</a>
            </div>
            <div class="menu hidden animate__animated">
                <i class="fa-solid fa-bars"></i>
            </div>
            <div class="logo">
                <div class="logo-tx">
                    <h1 class="l">L</h1>
                    <h1 class="s">S</h1>
                </div>
            </div>
            <div class="cart hidden animate__animated">
                <a href="https://www.instagram.com/llisboa.co/"><i class="fa-brands fa-instagram"></i></a>
                <a href="{{ route('carrinho') }}"><i class="fa-solid fa-cart-shopping"></i></a>
            </div>
        </div>
    </header>
    @yield('content')
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>