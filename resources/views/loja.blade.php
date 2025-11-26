@extends('base.base')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/loja.css') }}?v=13">
@endsection


@section('content')
    <main>
        <div class="container-loja">
            <div class="container-titulo">
                <div class="titulo-loja">
                @if ($pagProduto)
                    <h1>{{ $categoria->nome }}</h1>
                @else
                    <h1>Todos Os Produtos</h1>
                @endif
                    
                </div>
                <div class="filtros">

                    @if ($pagProduto)
                        <a class="button" href="{{ route('loja') }}">Todos</a>
                        @foreach ($tipos as $tipo)
                            @if ($categoria->nome == $tipo->nome)
                                <a class="button active" href="{{ route('lojaCategoria', ['id' => $tipo->id]) }}">{{ $tipo->nome }}</a>
                            @else
                                <a class="button" href="{{ route('lojaCategoria', ['id' => $tipo->id]) }}">{{ $tipo->nome }}</a>
                            @endif
                        @endforeach
                    @else
                        <a class="button active" href="{{ route('loja') }}">Todos</a>
                        @foreach ($tipos as $tipo)
                            <a class="button" href="{{ route('lojaCategoria', ['id' => $tipo->id]) }}">{{ $tipo->nome }}</a>
                        @endforeach
                    @endif
                </div>
            </div>


            <div class="loja">
                @foreach ($produtos as $produto)
                    <div class="produto {{ Str::slug($produto->tipo->nome) }}">
                        @if ($produto->esgotado)
                            <div class="esgot font-secundaria">
                                <p>ESGOTADO</p>
                            </div>
                        @endif
                        <div class="prod-img">
                            <a href="{{ route('pag.produto', ['id' => $produto->id]) }}">
                                <img src="{{ asset($produto->img) }}" alt="" loading="lazy">
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
            <div class="linksPaginate"
                {{ $produtos->links('partials.paginate') }}
            </div>
        </div>

        
    </main>
@endsection

@section('js')
    <script src="{{ asset('js/loja.js') }}"></script>
@endsection
