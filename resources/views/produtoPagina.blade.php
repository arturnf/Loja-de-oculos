@extends('base.base')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/produtoPagina.css') }}?v=13">
@endsection


@section('content')
    <main>
        <div class="container-produto">
            <div class="container-img">
                <div class="imgs-sec">
                    <img class="img" src="{{ asset($produto->img) }}" alt="">
                    @if ($produto->img2)
                        <img class="img" src="{{ asset($produto->img2) }}" alt="">
                    @endif
                    @if ($produto->img3)
                        <img class="img" src="{{ asset($produto->img3) }}" alt="">
                    @endif
                </div>
                <div class="img-main">
                    <img class="img-i" src="{{ asset($produto->img) }}" alt="">
                </div>
            </div>

            <div class="container-infos">
                <div class="titulo-produto hiddenT animate__animated">
                    <h1>{{ $produto->nome }}</h1>
                </div>
                <div class="frete hiddenT animate__animated">
                    <h3>🚚 Frete grátis</h3>
                    <p>apenas para região de pilar</p>
                </div>
                <div class="line"></div>
                <div class="preco hiddenT animate__animated">
                    <h1>R$ {{ number_format($produto->preco, 2, ',', '.') }}</h1>
                </div>
                @if ($produto->esgotado)
                    <div class="estoque hiddenT animate__animated">
                        <p>Estoque Indisponível</p>
                    </div>


                    <div class="adicione-contato hiddenT animate__animated">
                        <h1>ADICIONE SEU CONTATO</h1>
                    </div>


                    <form action="{{ route('criando.contato') }}" method="POST" class="formContato">
                        @csrf
                        <input type="hidden" name="produto_id" value="{{ $produto->id }}">
                        <div class="aviso hiddenT animate__animated">
                            <p>produto esgotado, assim que estiver disponível entraremos em contato!</p>
                        </div>

                        @if ($errors->has('nome'))
                            <span class="text-danger"><p>{{ $errors->first('nome') }}</p></span>
                        @endif
                        <div class="area-input hiddenT animate__animated">
                            <input type="text" name="nome" placeholder=" " required>
                            <span class="text">Seu Nome</span>
                        </div>
                        @if ($errors->has('numero'))
                            <span class="text-danger"><p>{{ $errors->first('numero') }}</p></span>
                        @endif
                        <div class="area-input hiddenT animate__animated">
                            <input type="text" name="numero" placeholder=" " required>
                            <span class="text">Seu Número para Contato</span>
                        </div>
                        <button class="button-comprar" type="submit">Enviar</button>
                    </form>
                @else
                    <div class="estoque hiddenT animate__animated">
                        <p>Estoque disponível</p>
                    </div>


                    <form class="form-comprar" action="{{ route('carrinho.addcarrinho') }}" method="POST">
                        @csrf
                        <input type="hidden" name="idProduto" value="{{ $produto->id }}">
                        <input type="hidden" name="img" value="{{ $produto->img }}">
                        <input type="hidden" name="nome" value="{{ $produto->nome }}">
                        <input type="hidden" name="preco" value="{{ $produto->preco }}">
                        <div class="quantidade">
                            <label for="quantidade">Quantidade:</label>
                            <div class="quantity-selector" data-stock="10">
                                <input type="number" value="1" min="1" name="quantidade">
                            </div>
                        </div>
                        <button class="button-comprar" type="submit" class="product-button">Adicionar ao Carrinho</button>
                    </form>
                @endif


            </div>
        </div>
    </main>
@endsection

@section('js')
    <script src="{{ asset('js/produto.js') }}"></script>
@endsection
