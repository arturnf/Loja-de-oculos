<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabela De Contatos</title>
    <link rel="stylesheet" href="{{ asset('css/adm/tabelaDeContatos.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <div class="logo">
            <h1>Lisboa<span>ADM</span></h1>
        </div>
        <div class="button-back">
            <a href="{{ route('admin.produtos') }}"><p>voltar</p></a>
        </div>
    </header>
    <main>
        <h1>Tabela de contatos do Produto: {{ $produto->nome }}</h1>
        <table>
            <tr>
                <th>Nome</th>
                <th>Número</th>
                <th></th>
            </tr>

            @if(!$contatos->isEmpty())
                @foreach($contatos as $contato)
                    <tr>
                        <td>{{ $contato->nome }}</td>
                        <td>{{ $contato->numero }}</td>
                        <td><a class="link" href="#"><i class="fa-solid fa-trash"></i></a></td>
                    </tr>
                @endforeach
            @endif
        </table>
    </main>
</body>
</html>