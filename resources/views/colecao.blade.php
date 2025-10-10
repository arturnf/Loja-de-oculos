@extends('base.base')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/colecao.css') }}?v=13">
@endsection


@section('content')
    <main>
        <div class="container-loja">
            <div class="img-colecao">
                <div class="img">
                    <img src="{{ asset($colecao->img) }}" alt="">
                </div>
                <div class="container-titulo">
                    <h1>{{ $colecao->nome }}</h1>
                </div>
            </div>



            <div class="loja">
                @foreach ($produtos as $produto)
                    <div class="produto">
                        @if ($produto->esgotado)
                            <div class="esgot font-secundaria">
                                <p>ESGOTADO</p>
                            </div>
                        @endif
                        <div class="prod-img">
                            <a href="{{ route('pag.produto', ['id' => $produto->id]) }}">
                                <img src="{{ asset($produto->img) }}" alt="">
                            </a>
                        </div>
                        <div class="botao-comprar">
                            @if ($produto->esgotado)
                                <a class="e-contato" href="{{ route('pag.produto', ['id' => $produto->id]) }}">Avise-me</a>
                            @else
                                <form action="{{ route('carrinho.addcarrinho') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="idProduto" value="{{ $produto->id }}">
                                    <input type="hidden" name="img" value="{{ $produto->img }}">
                                    <input type="hidden" name="nome" value="{{ $produto->nome }}">
                                    <input type="hidden" name="preco" value="{{ $produto->preco }}">
                                    <input type="hidden" name="quantidade" value="1">
                                    <button type="submit" class="product-button">Comprar</button>
                                </form>
                            @endif
                        </div>
                        <div class="nome-produto hiddenT animate__animated">
                            <p>{{ $produto->nome }}</p>
                        </div>
                        <div class="preco hiddenT animate__animated">
                            <p>R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </main>
@endsection
