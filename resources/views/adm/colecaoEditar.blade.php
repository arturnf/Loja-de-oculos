<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/adm/produtoEdit.css') }}">

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
        <a href="{{ route('admin.colecoes') }}">
            <h4>Voltar</h4>
        </a>
    </div>
    <main>
        <div class="container">
            <form action="{{ route('admin.process.colecao', ['id'=>$colecao->id]) }}" enctype="multipart/form-data"
                method="POST">
                @csrf
                @method('PUT')
                @if($errors->any())
                @foreach($errors->all() as $error)
                <p class="aviso"><i class="fa-solid fa-triangle-exclamation"></i> {{ $error }}</p>
                @endforeach
                @endif
                <div class="img">
                    <img id="preview" src="{{ asset($colecao->img) }}" alt="">
                    <div class="editar-foto">
                        <label class="label-file" for="fileInput">Editar Imagem</label>
                        <input class="input-file" id="fileInput" name="img" type="file" accept="image/*">
                    </div>
                </div>
                <div class="nome">
                    <input type="text" name="nome" value="{{ $colecao->nome }}">
                </div>
                <div class="desc">
                    <textarea name="descricao" id="" placeholder="descrição">{{ $colecao->descricao }}</textarea>
                </div>
                <button type="submit" class="botao">Atualizar</button>
            </form>
        </div>
    </main>
    <script>
        document.getElementById('fileInput').addEventListener('change', function (event) {
            const file = event.target.files[0]; // Obtém o arquivo selecionado
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('preview').src = e.target.result; // Atualiza o src da imagem
                };
                reader.readAsDataURL(file); // Lê o arquivo como uma URL
            }
        });
    </script>
</body>

</html>