<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $produto->nome }}</title>
    <link rel="stylesheet" href="{{ asset('css/produtoPagina.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="precnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body>
    <header>
        <div class="main-header">
            <div class="menu hidden animate__animated">
                <a href="{{ url()->previous() && url()->previous() !== url()->current() ? url()->previous() : route('home') }}"><i class="fa-solid fa-chevron-left"></i></a>
            </div>
            <div class="logo">
                <div class="logo-tx">
                    <h1 class="l">L</h1>
                    <h1 class="s">S</h1>
                </div>
            </div>
            <div class="cart hidden animate__animated">
                <a href="{{ route('carrinho') }}"><i class="fa-solid fa-cart-shopping"></i></a>
            </div>
        </div>
    </header>

    <main>
        @if(session('success'))
        <div class="confirm-remove">
            <h4>{{ session('success') }}</h4>
        </div>
        @endif
        <div class="container-main">
            <div class="container-img">
                <div class="img-main">
                    <img class="img-i" src="{{ asset($produto->img) }}" alt="">
                    @if($produto->esgotado)
                    <div class="esgot">
                        <p>Esgotado</p>
                    </div>
                    @endif
                </div>
                <div class="imgs-buttons">
                    <div class="img1">
                        <img class="img" src="{{ asset($produto->img) }}" alt="">
                    </div>
                    @if($produto->img2)
                    <div class="img2">
                        <img class="img" src="{{ asset($produto->img2) }}" alt="">
                    </div>
                    @endif
                    @if($produto->img3)
                    <div class="img3">
                        <img class="img" src="{{ asset($produto->img3) }}" alt="">
                    </div>
                    @endif
                </div>
            </div>


            <div class="container-infos">
                <div class="box">
                    <div class="title">
                        <h4>{{ $produto->nome }}</h4>
                    </div>
                    <div class="info">
                        <h4><i class="fa-solid fa-truck"></i> Frete grátis</h4>
                        <p>apenas para região de pilar</p>
                    </div>

                    <div class="preco">
                        <p>R$ {{ $produto->preco }}</p>
                    </div>
                    

                    @if($produto->esgotado)
                    <form action="{{ route('criando.contato') }}" method="POST" class="form-contato">
                        @csrf
                        <h4>Adicione seu contato</h4>
                        <p>produto esgotado, assim que estiver disponível entraremos em contato!</p>
                        @if($errors->any())
                        <div class="avisos">
                            @foreach($errors->all() as $error)
                                <div class="aviso">
                                    <h5><i class="fa-solid fa-triangle-exclamation"></i> {{ $error }}</h5>
                                </div>
                            @endforeach
                        </div>
                        @endif
                        <input type="hidden" name="produto_id" value="{{ $produto->id }}">
                        <input type="text" name="nome" placeholder="Seu Nome">
                        <input type="text" name="numero" placeholder="Seu Número para Contato">
                        <button type="submit" class="product-button hidden animate__animated">Enviar Contato</button>
                    </form>
                    @else
                    <form action="{{ route('carrinho.addcarrinho') }}" method="POST">
                        @csrf
                        <input type="hidden" name="img" value="{{ $produto->img }}">
                        <input type="hidden" name="nome" value="{{ $produto->nome }}">
                        <input type="hidden" name="preco" value="{{ $produto->preco }}">
                        <button type="submit" class="product-button hidden animate__animated">Adicionar ao carrinho</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </main>

    <script>
        let imgMain = document.querySelector('.img-i');
        const img = document.querySelectorAll('img');


        img.forEach(img => {
            img.addEventListener('click', () => {
                imgMain.src = img.src;
            });
        });
    </script>
</body>

</html>