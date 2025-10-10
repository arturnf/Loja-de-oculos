<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LisboaADM - InserirCupom</title>
    <link rel="stylesheet" href="{{ asset('css/adm/produtoCriar.css') }}?v=13">
    <link rel="stylesheet" href="{{ asset('css/adm/cupomCriar.css') }}?v=13">

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
        <a href="{{ route('lista.cupons') }}">
            <h4>Voltar</h4>
        </a>
    </div>
    <main>
        <div class="container">
            <div class="card">
                <h1>Adicionar Cupom</h1>
                <form action="{{ route('createCupom') }}" method="post" id="couponForm">
                    @csrf
                    <!-- Código -->
                    <div class="field">
                        <label for="code">Código do Cupom</label>
                        <div class="flex">
                            <input type="text" id="code" placeholder="EX: DESCONTO2025" maxlength="24" name="cupom" required>
                            <button type="button" class="btn-secondary" onclick="copyCode()">Copiar</button>
                        </div>
                        <label class="min-carrinho" for="quantidade_minima">Mínimo de Produtos no Carrinho</label>
                        <div class="flex">
                            <input type="text" id="quantidade_minima" placeholder="Quantidade" maxlength="24" name="quantidade_minima" required>
                        </div>
                    </div>

                    <!-- Desconto -->
                    <div class="field">
                        <label for="discount">Desconto (%)</label>
                        <div class="slider-container">
                            <input type="range" id="discountRange" min="0" max="100" value="10">
                            <input type="number" id="discount" min="0" max="100" value="10" name="desconto">
                        </div>
                    </div>

                    <!-- Botões -->
                    <div class="footer">
                        <button type="button" class="btn-secondary" onclick="resetForm()">Limpar</button>
                        <button type="submit" class="btn">Criar</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script>
        const codeInput = document.getElementById("code");
        const discountInput = document.getElementById("discount");
        const discountRange = document.getElementById("discountRange");

        // Sincroniza slider e input numérico
        discountInput.addEventListener("input", () => {
            let val = Math.min(100, Math.max(0, discountInput.value));
            discountInput.value = val;
            discountRange.value = val;
        });
        discountRange.addEventListener("input", () => {
            discountInput.value = discountRange.value;
        });

        function copyCode() {
            if (!codeInput.value) return;
            navigator.clipboard.writeText(codeInput.value).then(() => {
                alert("Código copiado: " + codeInput.value);
            });
        }

        function resetForm() {
            codeInput.value = "";
            discountInput.value = 0;
            discountRange.value = 0;
        }
    </script>
</body>

</html>