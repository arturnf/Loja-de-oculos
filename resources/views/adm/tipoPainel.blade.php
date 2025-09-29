<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LisboaADM - Tipos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/adm/produtosPainel.css') }}">

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
        <a href="{{ route('admin') }}">
            <h4>Voltar</h4>
        </a>
    </div>
    <main>
        @if(session('success'))
        <div class="confirm-remove">
            <h4>{{ session('success') }}</h4>
        </div>
        @endif
        @if(session('erro'))
        <div class="erro-remove">
            <h4>{{ session('erro') }}</h4>
        </div>
        @endif



        <div class="titulo-main">
            <h1>Tipos</h1>
        </div>
        <div class="container-list">

        @if(!$tipos->isEmpty())
            @foreach($tipos as $item)
                <div class="produto">
                    <div class="info">
                        <div class="titulo">
                            {{ $item->nome }}
                        </div>
                        
                    </div>
                    @if(!($item->nome == 'Óculos'))
                        <div class="buttons">
                            <a href="{{ route('admin.tipos.excluindo', ['id' => $item->id]) }}" class="trash"><i class="fa-solid fa-trash"></i></a>
                            <a href="{{ route('admin.tipos.editar', ['id' => $item->id]) }}" class="pen"><i class="fa-solid fa-pen"></i></a>
                        </div>
                    @else
                        <p>Esse Item Não Pode Ser Alterado!</p>
                    @endif
                    
                </div>
            @endforeach
        @else
            <h4>Não Há Tipos Cadastrados</h4>
        @endif    
        </div>
    </main>
    <div class="adicionar">
        <a href="{{ route('admin.tipos.inserir') }}">
            <h4>+</h4>
        </a>
    </div>

</body>

</html>