<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('favicon.png') }}?v=13" type="image/png">
    <title>Painel Administrativo</title>
    <link rel="stylesheet" href="{{ asset('css/adm/baseCadastrar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adm/base.css') }}">
    

    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <!--Font Google-->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body @if (session('success')) onload = "showNotification('{{ session('success') }}')" @elseif(session('error')) onload = "showNotificationError('{{ session('error') }}')" @endif>
    <main class="container-main">
        <div class="nav-bar">
            <div class="logo">
                <h1>Loja Admin</h1>
            </div>
            <p>Navegação</p>
            <nav>
                @yield('nav')
            </nav>

            <div class="close">
                <h1><i class="fa-solid fa-circle-xmark"></i></h1>
            </div>
        </div>

        <div id="notification-container"></div>

        <div class="contents-container">
            <div class="header-contents">
                <h1><i class="fa-solid fa-table"></i> Painel Administrativo</h1>
                <div class="menu-bar">
                    <i class="fa-solid fa-bars-staggered"></i>
                </div>
            </div>
            <div class="box-content">
                @yield('content')
            </div>
        </div>
    </main>
    <script src="{{ asset('js/adm/base.js') }}"></script>
</body>
</html>