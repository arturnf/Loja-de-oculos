<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-adm</title>
    <link rel="stylesheet" href="{{ asset('css/adm/painel.css') }}?v=2">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="precnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
</head>

<body>
    <header>
        <h1>Lisboa<span>ADM</span></h1>
        <a href="{{ route('logout') }}">Sair</a>
    </header>
    <div class="config">
        <a href="{{ route('admin.config') }}"><i class="fa-solid fa-gear"></i></a>
    </div>
    <main>
        <div class="aviso">
            <span>Atenção! O acesso é restrito à equipe. Não compartilhe as credenciais com terceiros.</span>
        </div>
        <div class="container-painel">
            <a href="{{ route('admin.colecoes') }}">
                <div class="card-colecao card">
                    <h1>Coleções</h1>
                </div>
            </a>
            <a href="{{ route('admin.tipos') }}">
                <div class="card-tipo card">
                    <h1>Tipos</h1>
                </div>
            </a>
            <a href="{{ route('admin.produtos') }}">
                <div class="card-produtos card">
                    <h1>Produtos</h1>
                </div>
            </a>

            <a href="{{ route('lista.cupons') }}">
                <div class="card-produtos card">
                    <h1>Cupons</h1>
                </div>
            </a>


        </div>
    </main>
</body>

</html>