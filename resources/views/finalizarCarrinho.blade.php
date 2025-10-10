<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="{{ asset('favicon.png') }}?v=13" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalização - LisboaCompany</title>
    <link rel="stylesheet" href="{{ asset('css/finalizandoCarrinho.css') }}?v=13">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Michroma&display=swap" rel="stylesheet">


</head>

<body>

    <div class="checkout-container">
        <div class="logo">LisboaCompany</div>


        <div class="steps">
            <div class="step">
                <span>1</span>
                <p>Resumo Da Compra</p>
            </div>
            <div class="step-active active">
                <span>2</span>
                <p>Entrega</p>
            </div>
        </div>


        <div class="resumo">
            <h3>Entrega</h3>
        </div>

        <div class="container-form">
            <form action="{{ route('carrinho.whatsapp') }}" method="post">
                @csrf
                <div class="area-input">
                    <input name="cidade" type="text" placeholder=" " required>
                    <span class="text">Cidade</span>
                </div>

                <div class="area-input">
                    <input  name="rua" type="text" placeholder=" " required>
                    <span class="text">Rua</span>
                </div>

                <div class="area-input">
                    <input name="bairro" type="text" placeholder=" " required>
                    <span class="text">Bairro</span>
                </div>

                <div class="area-input">
                    <input name="numero" type="text" placeholder=" ">
                    <span class="text">Número da Casa</span>
                </div>
                <div class="button-finalizar">
                    <button type="submit">COMPRAR</button>
                </div>
                <div class="combinar">
                    <a href="{{ route('carrinho.whatsapp.combinar') }}">Combinar Retirada</a>
                </div>
            </form>
        </div>
    </div>
    <div class="carrinho">
        <a href="{{ route('carrinho') }}"><i class="fa-solid fa-cart-shopping"></i>Voltar Para o Carrinho</a>
    </div>

</body>

</html>