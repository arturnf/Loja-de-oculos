<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LisboaADM - InserirProduto</title>
    <link rel="stylesheet" href="{{ asset('css/adm/produtoCriar.css') }}?v=2">

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
        <a href="{{ route('admin.produtos') }}">
            <h4>Voltar</h4>
        </a>
    </div>
    <main>
        <div class="container">
            <form action="{{ route('capturando') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="img">
                    <img id="preview" src="{{ asset('img/foto.PNG') }}" alt="">
                    <div class="editar-foto">
                        <label class="label-file" for="fileInput">Importar Imagem</label>
                        <div class="nome-img"></div>
                        <input class="input-file" id="fileInput" name="img" type="file" accept="image/*">
                    </div>
                </div>
                <div class="nome">
                    <input type="text" name="nome" placeholder="Nome">
                </div>
                <div class="preco">
                    <input type="number" name="preco" step="0.01" placeholder="Preço, exemplo: 12.30">
                </div>
                <select name="tipo" class="select tipo">
                    <option value="">Selecione um Tipo</option>
                    @foreach($tipo as $item)
                        <option value="{{ $item->id }}">{{ $item->nome }}</option>
                    @endforeach
                </select>
                <select name="colecao" class="select colecao">
                    <option value="">Selecione uma Coleção</option>
                    @foreach($colecoes as $colecao)
                        <option value="{{ $colecao->id }}">{{ $colecao->nome }}</option>
                    @endforeach
                </select>


                <h1 class="outras-text">Outras Imagens</h1>
                <div class="outras-imagens">
                    <div class="img">
                        <img id="preview2" src="{{ asset('img/foto.PNG') }}" alt="IMAGEM" draggable="false">
                        <div class="editar-foto">
                            <label class="label-file" for="fileInput2">Importar Imagem</label>
                            <div class="nome-img2"></div>
                            <input class="input-file" id="fileInput2" name="img2" type="file" accept="image/*">
                        </div>
                    </div>

                    <div class="img">
                        <img id="preview3" src="{{ asset('img/foto.PNG') }}" alt="IMAGEM" draggable="false">
                        <div class="editar-foto">
                            <label class="label-file" for="fileInput3">Importar Imagem</label>
                            <div class="nome-img3"></div>
                            <input class="input-file" id="fileInput3" name="img3" type="file" accept="image/*">
                        </div>
                    </div>
                </div>                


                <button type="submit" class="botao">Criar</button>
            </form>
        </div>
    </main>
    <script>
        const nomeImg = document.querySelector('.nome-img');
        document.getElementById('fileInput').addEventListener('change', function (event) {
            const file = event.target.files[0]; // Obtém o arquivo selecionado
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('preview').src = e.target.result; // Atualiza o src da imagem
                    console.log(file);
                    const titulo = document.createElement("p");
                    titulo.textContent = file.name;
                    nomeImg.appendChild(titulo);
                };
                reader.readAsDataURL(file); // Lê o arquivo como uma URL
            }
        });

        const nomeImg2 = document.querySelector('.nome-img2');
        document.getElementById('fileInput2').addEventListener('change', function (event) {
            const file = event.target.files[0]; // Obtém o arquivo selecionado
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('preview2').src = e.target.result; // Atualiza o src da imagem
                    console.log(file);
                    const titulo = document.createElement("p");
                    titulo.textContent = file.name;
                    nomeImg2.appendChild(titulo);
                };
                reader.readAsDataURL(file); // Lê o arquivo como uma URL
            }
        });

        const nomeImg3 = document.querySelector('.nome-img3');
        document.getElementById('fileInput3').addEventListener('change', function (event) {
            const file = event.target.files[0]; // Obtém o arquivo selecionado
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('preview3').src = e.target.result; // Atualiza o src da imagem
                    console.log(file);
                    const titulo = document.createElement("p");
                    titulo.textContent = file.name;
                    nomeImg3.appendChild(titulo);
                };
                reader.readAsDataURL(file); // Lê o arquivo como uma URL
            }
        });
    </script>
</body>

</html>