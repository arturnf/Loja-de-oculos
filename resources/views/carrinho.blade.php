<!DOCTYPE html>
<html lang="pt-BR" translate="no">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="{{ asset('favicon.PNG') }}" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho</title>
    <link rel="stylesheet" href="{{ asset('css/carrinho.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="precnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" />
</head>

<body 
@error('cupom')
    onload="showNotification('{{ $message }}')"
@enderror
>
    <div id="notification-container"></div>
    <header>
        <div class="button-voltar">
            <a href="{{ route('home') }}">Voltar</a>
        </div>
        <div class="main-header">
            <div class="logo">
                <div class="logo-tx">
                    <h1 class="l">L</h1>
                    <h1 class="s">S</h1>
                </div>
            </div>
        </div>
    </header>

    <div class="cart-container">
        @if(session('erroCarrinho'))
        <div class="erro">
            <h4>{{ session('erroCarrinho') }}</h4>
        </div>
        @endif
        
        <h2>Carrinho de Compras</h2>

        @if(!empty($lista))
        @foreach($lista as $item)
        <div class="cart-item">
            <img src="{{ asset($item['img']) }}" alt="Produto" class="cart-img">
            <div class="cart-details">
                <h3>{{ $item['nome'] }}</h3>
                <p class="price">R$ {{ $item['preco'] }}</p>
            </div>
            <a href="{{ route('carrinho.excluircarrinho', ['id' => $item['id']]) }}" class="remove-btn"><i
                        class="fa-solid fa-trash"></i></a>
        </div>
        @endforeach
        @endif
        <!-- Resumo -->
        <div class="cart-summary">
            @if(empty(session('cupom')))
            <form action="{{ route('add.cupom') }}" class="coupon" method="post">
                @csrf
                <div class="coupon-left">
                    <span>💰</span>
                </div>
                <div class="coupon-right">
                    <h3>Tem um cupom?</h3>
                    <p>Adicione seu código abaixo:</p>
                    <div class="coupon-input">
                        <input type="text" placeholder="Digite o cupom" name="cupom">
                        <button type="submit">Aplicar</button>
                    </div>
                </div>
            </form>
            @else
            <div class="coupon-ap">
                <div class="coupon-left-ap">
                    <span>💰</span>
                </div>
                <div class="coupon-right-ap">
                    <h3>Cupom aplicado!</h3>
                    <p>{{ session('cupom.desconto') }}% de desconto</p>
                </div>

                <div class="trash-coupon">
                    <a href="{{ route('remove.cupom') }}"><i class="fa-solid fa-trash"></i></a>
                </div>
            </div>
            @endif


            <p>Subtotal: R$ {{ number_format($subtotal, 2, ',', '.') }}</p>
            <p>Desconto: -R$ {{ number_format($desconto, 2, ',', '.') }}</p>
            <h3>Total: R$ {{ number_format($total, 2, ',', '.') }}</h3>

            <a href="{{ route('carrinho.final') }}" class="checkout-btn">Finalizar Compra</a>

        </div>
    </div>
    <script>
        function showNotification(message) {
            const container = document.getElementById("notification-container");

            // Criar a notificação
            const notification = document.createElement("div");
            notification.classList.add("notification");
            notification.innerText = message;

            // Criar barra de progresso
            const progressBar = document.createElement("div");
            progressBar.classList.add("progress-bar");

            const progress = document.createElement("div");
            progress.classList.add("progress");

            progressBar.appendChild(progress);
            notification.appendChild(progressBar);

            // Adicionar na tela
            container.appendChild(notification);

            // Forçar o reflow para garantir que a animação inicie corretamente
            void progress.offsetWidth;

            // Iniciar animação (3 segundos)
            progress.style.transitionDuration = "3s";
            progress.style.width = "100%";

            // Remover a notificação após 3 segundos
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }
    </script>
</body>

</html>