@extends('base.base')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/produtoPagina.css') }}?v=16">
@endsection

@section('content')
    @php
        $imagens = collect([$produto->img, $produto->img2, $produto->img3])->filter()->values();
    @endphp

    <main>
        <div class="container-produto">
            <div class="container-img">
                <div class="gallery-shell">
                    <div class="imgs-sec" aria-label="Galeria de imagens do produto">
                        @foreach ($imagens as $index => $imagem)
                            <button type="button" class="thumb-btn {{ $loop->first ? 'is-active' : '' }}" data-image="{{ asset($imagem) }}" aria-label="Ver imagem {{ $index + 1 }}">
                                <img src="{{ asset($imagem) }}" alt="{{ $produto->nome }} {{ $index + 1 }}">
                            </button>
                        @endforeach
                    </div>

                    <div class="img-main">
                        <img class="img-i" src="{{ asset($imagens->first() ?? $produto->img) }}" alt="{{ $produto->nome }}">
                    </div>
                </div>
            </div>

            <div class="container-infos">
                <div class="info-card">
                    <div class="product-badges hiddenT animate__animated">
                        @if ($produto->colecao)
                            <span class="badge badge-dark">{{ $produto->colecao->nome }}</span>
                        @else
                            <span class="badge badge-dark">Sem coleção</span>
                        @endif
                        @if ($produto->esgotado)
                            <span class="badge badge-warning">Esgotado</span>
                        @else
                            <span class="badge badge-success">Em estoque</span>
                        @endif
                    </div>

                    <div class="titulo-produto hiddenT animate__animated">
                        <h1>{{ $produto->nome }}</h1>
                    </div>

                    @if ($produto->tipo)
                        <p class="product-category hiddenT animate__animated">{{ $produto->tipo->nome }}</p>
                    @endif

                    <div class="frete hiddenT animate__animated">
                        <h3>🚚 Frete grátis</h3>
                        <p>apenas para a região de Pilar</p>
                    </div>

                    <div class="line"></div>

                    @if ($produto->preco_antigo)
                        <div class="preco_antigo hiddenT animate__animated">
                            <p>R$ {{ number_format($produto->preco_antigo, 2, ',', '.') }}</p>
                        </div>
                    @endif

                    <div class="preco hiddenT animate__animated">
                        <h1>R$ {{ number_format($produto->preco, 2, ',', '.') }}</h1>
                    </div>

                    @if ($produto->descricao)
                        <div class="product-description hiddenT animate__animated">
                            <h3>Descrição</h3>
                            <p>{{ $produto->descricao }}</p>
                        </div>
                    @endif

                    @if ($produto->esgotado)
                        <div class="estoque hiddenT animate__animated">
                            <p>Estoque indisponível no momento</p>
                        </div>

                        <div class="adicione-contato hiddenT animate__animated">
                            <h2>Receba aviso quando chegar</h2>
                        </div>

                        <form action="{{ route('criando.contato') }}" method="POST" class="formContato">
                            @csrf
                            <input type="hidden" name="produto_id" value="{{ $produto->id }}">
                            <div class="aviso hiddenT animate__animated">
                                <p>Produto esgotado. Enviaremos seu contato assim que estiver disponível.</p>
                            </div>

                            @if ($errors->has('nome'))
                                <span class="text-danger">
                                    <p>{{ $errors->first('nome') }}</p>
                                </span>
                            @endif
                            <div class="area-input hiddenT animate__animated">
                                <input type="text" name="nome" placeholder=" " required>
                                <span class="text">Seu Nome</span>
                            </div>
                            @if ($errors->has('numero'))
                                <span class="text-danger">
                                    <p>{{ $errors->first('numero') }}</p>
                                </span>
                            @endif
                            <div class="area-input hiddenT animate__animated">
                                <input type="text" name="numero" placeholder=" " required>
                                <span class="text">Seu Número para Contato</span>
                            </div>
                            <button class="button-comprar" type="submit">Enviar</button>
                        </form>
                    @else
                        <div class="estoque hiddenT animate__animated">
                            <p>Disponível para compra</p>
                        </div>

                        <form class="form-comprar" action="{{ route('carrinho.addcarrinho') }}" method="POST">
                            @csrf
                            <input type="hidden" name="idProduto" value="{{ $produto->id }}">
                            <input type="hidden" name="img" value="{{ $produto->img }}">
                            <input type="hidden" name="nome" value="{{ $produto->nome }}">
                            <input type="hidden" name="preco" value="{{ $produto->preco }}">
                            <div class="quantidade">
                                <label for="quantidade">Quantidade</label>
                                <div class="quantity-selector" data-stock="10">
                                    <input type="number" value="1" min="1" name="quantidade">
                                </div>
                            </div>
                            <button class="button-comprar" type="submit">Adicionar ao Carrinho</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script src="{{ asset('js/produto.js') }}"></script>
@endsection
