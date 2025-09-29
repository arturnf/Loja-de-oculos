<!DOCTYPE html>
<html lang="pt-BR" translate="no">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LisboaADM - Login</title>
    <link rel="stylesheet" href="{{ asset('css/adm/login.css') }}?v=2">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <main>
        <div class="container">
            <div class="icone">
                <h4>LisBoa <span>ADM</span></h4>
            </div>

            @if($errors->any())
                @foreach($errors->all() as $error)
                    <p class="aviso"><i class="fa-solid fa-triangle-exclamation"></i> {{ $error }}</p>
                @endforeach
            @endif

            <div class="formulario">
                <form action="{{ route('auth') }}" method="POST">
                    @csrf
                    <div class="email">
                        <label for="name">USUÁRIO</label>
                        <input type="text" name="name">
                    </div>
                    <div class="senha">
                        <label for="password">SENHA</label>
                        <input type="password" name="password">
                    </div>

                    <input id="botao" type="submit" value="Login">
                </form>
            </div>
        </div>

    </main>
</body>

</html>