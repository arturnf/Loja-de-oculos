<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="{{ asset('favicon.png') }}?v=13" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalização - LisboaCompany</title>
    <link rel="stylesheet" href="{{ asset('css/carrinho.css') }}?v=13">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Michroma&display=swap" rel="stylesheet">


</head>

<body @error('cupom')
    onload = "showNotification('{{ $message }}')"
@enderror
    @if (session('erroCarrinho')) onload = "showNotification('{{ session('erroCarrinho') }}')" @endif>


    <div id="notification-container"></div>
    <div class="checkout-container">


        <div class="logo">
            <a href="{{ route('home') }}">LisboaCompany</a>
        </div>


        <div class="steps">
            <div class="step-active active">
                <span>1</span>
                <p>Resumo Da Compra</p>
            </div>
            <div class="step">
                <span>2</span>
                <p>Entrega</p>
            </div>
        </div>


        <div class="resumo">
            <h3>Resumo</h3>

            <div class="container-produto">
                @if (!empty($lista))
                    @foreach ($lista as $item)
                        <div class="produto">
                            <div class="trash-poduct">
                                <a href="{{ route('carrinho.excluircarrinho', ['id' => $item['id']]) }}">
                                    <h1>X</h1>
                                </a>
                            </div>
                            <div class="img-produto">
                                <img src="{{ asset($item['img']) }}" alt="">
                            </div>
                            <div class="info-produto">
                                <div class="nome-produto">
                                    <p>{{ $item['nome'] }}</p>
                                </div>
                                <div class="preco-produto">
                                    <p>R$ {{ number_format($item['preco'], 2, ',', '.') }}</p>
                                </div>
                                <div class="quantidade-produto">
                                    <form hx-post="{{ route('atualizar.carrinho') }}" hx-trigger="change"
                                        hx-target="#cart-summary" hx-swap="outerHTML">
                                        @csrf
                                        <label for="quantity">Quantidade:</label>
                                        <input type="number" name="quantity" value="{{ $item['quantidade'] }}"
                                            min="1">
                                        <input type="hidden" name="precarrinho" value="false" min="1">
                                        <input type="hidden" name="idProduto" value="{{ $item['idProduto'] }}">
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            

            @if (empty($cupom))
                <div class="div-cupom">
                    <p>Tem um cupom?</p>
                </div>
                <div class="cupom">
                    <form action="{{ route('add.cupom') }}" method="post">
                        @csrf
                        <input type="text" placeholder="Código do cupom" name="cupom">
                        <button>Adicionar</button>
                    </form>

                </div>
            @else
                <div class="cupom-aplicado">
                    <div class="infos-cupom">
                        <h1>Cupom: {{ $cupom['codigo'] }} <strong>aplicado</strong></h1>
                        <p>{{ $cupom['desconto'] }}% de desconto</p>
                    </div>
                    <div class="trash-cupom">
                        <a href="{{ route('remove.cupom') }}">X</a>
                    </div>
                </div>
            @endif

            <div id="cart-summary">
                <div class="subtotal">
                    <span>Subtotal</span>
                    <span>R$ {{ number_format($subtotal, 2, ',', '.') }}</span>
                </div>
                <div class="desconto">
                    <span>Desconto</span>
                    <span>R$ {{ number_format($desconto, 2, ',', '.') }}</span>
                </div>
                <div class="total">
                    <span>Total</span>
                    <span>R$ {{ number_format($total, 2, ',', '.') }}</span>
                </div>
            </div>


        </div>
    </div>
    <div class="button-finalizar">
        <a href="{{ route('carrinho.final') }}">FINALIZAR COMPRA</a>
    </div>

    <script src="{{ asset('js/carrinho.js') }}"></script>
    <script src="https://unpkg.com/htmx.org@1.9.10"></script>
</body>

</html>
