<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LisboaADM - InserirProduto</title>
    <link rel="stylesheet" href="{{ asset('css/adm/produtoCriar.css') }}">

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
    <div class="back">
        <a href="{{ route('admin.tipos') }}">
            <h4>Voltar</h4>
        </a>
    </div>
    <main>
        <div class="container">
            <form action="{{ route('admin.tipos.criando') }}" enctype="multipart/form-data" method="POST">
                @csrf
                
                <div class="nome">
                    <input type="text" name="nome" placeholder="Nome">
                </div>

                <button type="submit" class="botao">Criar</button>
            </form>
        </div>
    </main>
</body>

</html>