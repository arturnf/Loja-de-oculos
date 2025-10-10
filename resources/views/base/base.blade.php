<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="{{ asset('favicon.png') }}?v=13" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lisboa Company</title>
    <link rel="stylesheet" href="{{ asset('css/base.css') }}?v=13">
    @yield('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Michroma&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body @if (session('successContato')) onload = "showNotification('{{ session('successContato') }}')" @endif>
    <div class="container-header">
        <header>
            <div class="menu-hamb hiddenT animate__animated">
                <i class="fa-solid fa-bars"></i>
            </div>

            <div class="logo hiddenT animate__animated">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('img/logo.png') }}" alt="">
                </a>
            </div>

            <nav class="hiddenT animate__animated">
                <a href="{{ route('home') }}">Início</a>
                <a href="{{ route('loja') }}">Loja</a>
                <a href="{{ route('colecoes') }}">Coleções</a>
                <a href="{{ route('contato') }}">Contato</a>
                <a href="{{ route('sobre') }}">Sobre</a>
            </nav>

            <div class="cart hiddenT animate__animated">
                <a href="https://www.instagram.com/llisboa.co/" target="_blank"><i
                        class="fa-brands fa-instagram"></i></a>
                <a id="cart" href="#"><i class="fa-solid fa-cart-shopping"></i></a>
            </div>
        </header>
    </div>

    <div id="notification-container"></div>

    <div class="menu-mobile">
        <div class="button-close">
            <h1>X</h1>
        </div>
        <nav>
            <a class="hiddenT animate__animated" href="{{ route('home') }}">Início</a>
            <a class="hiddenT animate__animated" href="{{ route('loja') }}">Loja</a>
            <a class="hiddenT animate__animated" href="{{ route('colecoes') }}">Coleções</a>
            <a class="hiddenT animate__animated" href="{{ route('contato') }}">Contato</a>
            <a class="hiddenT animate__animated" href="{{ route('sobre') }}">Sobre</a>
        </nav>
    </div>





    <div class="container-cart-main oculto">
    </div>
    <div class="carrinho">
        <div class="container-carrinho">
            <div class="header-carrinho">
                <p class="hiddenT animate__animated">Meu Carrinho</p>
                <div class="div-close-carrinho">
                    <p><i class="fa-solid fa-xmark"></i></p>
                </div>
            </div>
            <div class="main-carrinho">
                @php
                    $itens = session('listaDeObjetosSession', []);
                    $total = 0;

                    foreach ($itens as $item) {
                        $total += floatval($item['preco']) * $item['quantidade'];
                    }
                @endphp
                @forelse($itens as $item)
                    <div class="produto-carrinho">

                        <div class="trash-produto">
                            <a href="{{ route('carrinho.excluircarrinho', ['id' => $item['id']]) }}">
                                <h1>X</h1>
                            </a>
                        </div>
                        <div class="img-produto-carrinho">
                            <img src="{{ asset($item['img']) }}" alt="">
                        </div>
                        <div class="container-infos-produto">
                            <div class="titulo-produto-carrinho hiddenT animate__animated">
                                <h4>{{ $item['nome'] }}</h4>
                            </div>
                            <div class="preco-produto-carrinho hiddenT animate__animated">
                                <p>R$ {{ $item['preco'] }}</p>
                            </div>
                            <div class="quantidade-produto-carrinho hiddenT animate__animated">
                                <form hx-post="{{ route('atualizar.carrinho') }}" hx-trigger="change"
                                    hx-target="#pre-cart-summary" hx-swap="outerHTML">
                                    @csrf
                                    <label for="quantity">Quantidade:</label>
                                    <input class="quantidadeCarrinho" type="number" name="quantity" value="{{ $item['quantidade'] }}"
                                        min="1">
                                    <input type="hidden" name="precarrinho" value="true" min="1">
                                    <input type="hidden" name="idProduto" value="{{ $item['idProduto'] }}">
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p></p>
                @endforelse
            </div>
            <div class="botoes-carrinho">
                <div id="pre-cart-summary" class="total-carrinho">
                    <p>Total:</p>
                    <h1>R$ {{ number_format($total, 2, ',', '.') }}</h1>
                </div>
                <div class="finalizar">
                    <a href="{{ route('carrinho') }}">FINALIZAR A COMPRA</a>
                </div>
                <div class="continuar">
                    <p>CONTINUAR COMPRANDO</p>
                </div>
            </div>
        </div>
    </div>


    @yield('content')



    <footer class="footer">
        <div class="footer-container">
            <div class="footer-brand">Lisboa Company</div>
            <div class="footer-links">
                <a href="{{ route('encaminhando') }}" target="_blank" aria-label="WhatsApp">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="white"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 0c-6.627 0-12 5.373-12 12 0 2.114.552 4.086 1.51 5.797l-1.572 6.203 6.352-1.538c1.653.904 3.542 1.427 5.71 1.427 6.627 0 12-5.373 12-12s-5.373-12-12-12zm0 21.75c-1.853 0-3.558-.527-5.004-1.439l-.36-.215-3.771.914.889-3.64-.234-.374c-.867-1.391-1.375-3.026-1.375-4.746 0-5.11 4.14-9.25 9.25-9.25s9.25 4.14 9.25 9.25-4.14 9.25-9.25 9.25zm4.941-6.708c-.27-.135-1.598-.786-1.846-.875-.248-.09-.429-.135-.61.135s-.7.875-.858 1.055c-.158.18-.316.203-.586.068-.27-.135-1.141-.42-2.174-1.34-.804-.716-1.347-1.598-1.505-1.868-.158-.27-.017-.416.119-.55.122-.121.27-.316.405-.474.135-.158.18-.27.27-.45.09-.18.045-.338-.022-.474-.068-.135-.61-1.472-.835-2.017-.22-.528-.445-.456-.61-.465l-.52-.009c-.18 0-.474.068-.721.338-.248.27-.946.923-.946 2.25s.968 2.61 1.103 2.79c.135.18 1.906 2.906 4.623 4.077.646.278 1.149.445 1.541.57.647.207 1.234.178 1.699.108.518-.077 1.598-.653 1.825-1.282.225-.63.225-1.169.158-1.282-.068-.113-.247-.18-.518-.315z" />
                    </svg>
                </a>
                <a href="https://www.instagram.com/llisboa.co/" target="_blank" aria-label="Instagram">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="white"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 2.163c3.204 0 3.584.012 4.85.07 1.17.056 1.97.246 2.427.415a4.9 4.9 0 0 1 1.75 1.145 4.9 4.9 0 0 1 1.145 1.75c.169.457.359 1.257.415 2.427.058 1.266.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.056 1.17-.246 1.97-.415 2.427a4.9 4.9 0 0 1-1.145 1.75 4.9 4.9 0 0 1-1.75 1.145c-.457.169-1.257.359-2.427.415-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-1.17-.056-1.97-.246-2.427-.415a4.9 4.9 0 0 1-1.75-1.145 4.9 4.9 0 0 1-1.145-1.75c-.169-.457-.359-1.257-.415-2.427-.058-1.266-.07-1.646-.07-4.85s.012-3.584.07-4.85c.056-1.17.246-1.97.415-2.427a4.9 4.9 0 0 1 1.145-1.75 4.9 4.9 0 0 1 1.75-1.145c.457-.169 1.257-.359 2.427-.415 1.266-.058 1.646-.07 4.85-.07zm0-2.163c-3.259 0-3.667.012-4.947.071-1.281.06-2.159.262-2.918.558a7.07 7.07 0 0 0-2.565 1.67 7.07 7.07 0 0 0-1.67 2.565c-.296.759-.498 1.637-.558 2.918-.059 1.28-.071 1.688-.071 4.947s.012 3.667.071 4.947c.06 1.281.262 2.159.558 2.918a7.07 7.07 0 0 0 1.67 2.565 7.07 7.07 0 0 0 2.565 1.67c.759.296 1.637.498 2.918.558 1.28.059 1.688.071 4.947.071s3.667-.012 4.947-.071c1.281-.06 2.159-.262 2.918-.558a7.07 7.07 0 0 0 2.565-1.67 7.07 7.07 0 0 0 1.67-2.565c.296-.759.498-1.637.558-2.918.059-1.28.071-1.688.071-4.947s-.012-3.667-.071-4.947c-.06-1.281-.262-2.159-.558-2.918a7.07 7.07 0 0 0-1.67-2.565 7.07 7.07 0 0 0-2.565-1.67c-.759-.296-1.637-.498-2.918-.558-1.28-.059-1.688-.071-4.947-.071zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zm0 10.162a3.999 3.999 0 1 1 0-7.998 3.999 3.999 0 0 1 0 7.998zm6.406-11.845a1.44 1.44 0 1 1 0-2.88 1.44 1.44 0 0 1 0 2.88z" />
                    </svg>
                </a>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/base.js') }}"></script>
    <script src="https://unpkg.com/htmx.org@1.9.10"></script>
    @yield('js')
    @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", () => {

                abrirCarrinho();
            });
        </script>
    @endif
    @if (session('erroAdd'))
        <script>
            document.addEventListener("DOMContentLoaded", () => {

                abrirCarrinho();
            });
        </script>
    @endif
</body>

</html>
