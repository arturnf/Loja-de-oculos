@extends('base.base')

@section('title')
<title>LisboaCompany - loja</title>
@endsection


@section('content')

<div class="container-main-loja">
    @if(session('success'))
    <div class="confirm-remove">
        <h4>{{ session('success') }}</h4>
    </div>
    @endif
    <div class="title-loja">
        <h1>Loja</h1>
    </div>
    <div class="container-tipos">
        @foreach($tipos as $tipo)
        <a href="/loja/{{ $tipo->id }}">{{ $tipo->nome }}</a>
        @endforeach
    </div>
    <div class="tipo-titulo">
        <h4>{{ $tipoOne->nome }}</h4>
    </div>

    <div class="conainter-cards">
        @foreach ($produtos as $produto)
        <div class="product">
            <div class="product-img">
                <a href="{{  route('pag.produto', ['id' => $produto->id]) }}">
                    <img src="{{ asset($produto->img) }}" alt="">
                </a>
            </div>
            <div class="product-title hidden animate__animated">
                {{ $produto->nome }}
            </div>
            <div class="product-price hidden animate__animated">
                <p>R$ {{ $produto->preco }}</p>
            </div>


            @if($produto->esgotado)
                <div class="button-esgotado">
                    <a href="{{  route('pag.produto', ['id' => $produto->id]) }}">Avise-me quando chegar</a>
                </div>

                <div class="esgot">
                    <p>Esgotado</p>
                </div>
            @else
                 <div class="button">
                    <a href="{{  route('pag.produto', ['id' => $produto->id]) }}">COMPRAR</a>
                 </div>
            @endif
        </div>
        @endforeach

        
    </div>
    {{ $produtos->onEachSide(1)->links('vendor.pagination.bootstrap-5') }}

</div>
@endsection