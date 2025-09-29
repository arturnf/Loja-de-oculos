<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lisboa - settings</title>
    <link rel="stylesheet" href="{{ asset('css/adm/config.css') }}">
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
            <h3>{{ session('success') }}</h3>
        </div>
        @endif
        <h4>Configuração</h4>
        <form action="{{ route('admin.config.process', ['id' => $numero->id]) }}" method="post">
            @csrf
            @method('PUT')
            <label for="numero">Seu Numero</label>
            <input type="text" value="{{ $numero->numero }}" name="numero">
            <button type="submit">ATUALIZAR</button>
            <p>Atenção: O número deve ser informado sem traços ou espaços. Exemplo: 5582900000000.</p>
        </form>
    </main>
</body>

</html>