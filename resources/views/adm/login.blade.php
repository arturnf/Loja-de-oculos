<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('favicon.png') }}?v=13" type="image/png">
    <title>Login | Lisboa Company</title>
    <link rel="stylesheet" href="{{ asset('css/adm/login.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="icon-box">
                <i class="fa-solid fa-building"></i>
            </div>
            <h1>Lisboa Company</h1>
            <p class="subtitle">Acesse o painel administrativo</p>

            <form action="{{ route('auth') }}" method="POST">
                @csrf
                <label for="email">Usuário</label>
                <input type="text" name="name" id="email" placeholder="Usuário" required>

                <label for="password">Senha</label>
                <input type="password" name="password" id="password" placeholder="********" required>

                <button type="submit">Entrar</button>
            </form>

        </div>
    </div>
</body>
</html>
