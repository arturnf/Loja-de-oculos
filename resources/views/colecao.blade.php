<!DOCTYPE html>
<html lang="pt-BR" translate="no">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="{{ asset('favicon.PNG') }}" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $colecao->nome }}</title>
    <link rel="stylesheet" href="{{ asset('css/colecao.css') }}">
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
        <div class="carrinho">
            <a href="{{ route('carrinho') }}"><i class="fa-solid fa-cart-shopping"></i></a>
        </div>
        <div class="nav">
            <a href="{{ route('home') }}">
                <p>Voltar</p>
            </a>

        </div>
        <div class="img-header">
            <img src="{{ asset($colecao->img) }}" alt="">
        </div>
    </header>
    <main>
        @if(session('success'))
        <div class="confirm-remove">
            <h4>{{ session('success') }}</h4>
        </div>
        @endif
        <div class="title hidden animate__animated">
            <h1>{{ $colecao->nome }}</h1>
        </div>

        <div class="conainter-cards">
            <div class="desc">
            @if($colecao->descricao)
                <p>{{ $colecao->descricao }}</p>
            @endif
            </div>

            @if($produtos->isNotEmpty())
            @foreach ($produtos as $item)
            <div class="product">
                <div class="product-img">
                    <a href="{{  route('pag.produto', ['id' => $item->id]) }}">
                        <img src="{{ asset($item->img) }}" alt="">
                    </a>
                </div>
                <div class="product-title hidden animate__animated">
                    {{ $item->nome }}
                </div>
                <div class="product-price hidden animate__animated">
                    <p>R$ {{ $item->preco }}</p>
                </div>

                @if($item->esgotado)
                <div class="button-esgotado">
                    <a href="{{  route('pag.produto', ['id' => $item->id]) }}">Avise-me quando chegar</a>
                </div>

                <div class="esgot">
                    <p>Esgotado</p>
                </div>
                @else
                 <div class="button">
                    <a href="{{  route('pag.produto', ['id' => $item->id]) }}">COMPRAR</a>
                 </div>
                @endif


            </div>
            @endforeach

            @else
            <h1 class="empty">Não Há Produto</h1>
            @endif


        </div>
    </main>


    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>