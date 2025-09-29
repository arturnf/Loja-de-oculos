<!DOCTYPE html>
<html lang="pt-BR" translate="no">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="{{ asset('favicon.PNG') }}" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lisboa - Confirmar</title>
    <link rel="stylesheet" href="{{ asset('css/finalizandoCarrinho.css') }}">
</head>

<body>
    <header>
        <div class="button-voltar">
            <a href="{{ route('carrinho') }}">Voltar</a>
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

        <div class="checkout-container">
            <h2>Endereço de Entrega</h2>
            <form action="{{ route('carrinho.whatsapp') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="cidade">Cidade</label>
                    <input type="text" id="cidade" name="cidade" placeholder="Ex: Pilar" required>
                </div>

                <div class="form-group">
                    <label for="rua">Rua</label>
                    <input type="text" id="rua" name="rua" placeholder="Ex: Rua Luiz Ramo" required>
                </div>

                <div class="form-group">
                    <label for="bairro">Bairro</label>
                    <input type="text" id="bairro" name="bairro" placeholder="Ex: Centro" required>
                </div>

                <div class="form-group">
                    <label for="numero">Número da Casa</label>
                    <input type="text" id="numero" name="numero" placeholder="Ex: 123">
                </div>
                
                <button type="submit" class="btn-submit">Enviar</button>
            </form>
    
            <a href="{{ route('carrinho.whatsapp.combinar') }}" class="pickup-link">👉 Combinar Retirada</a>
        </div>


    

</body>

</html>