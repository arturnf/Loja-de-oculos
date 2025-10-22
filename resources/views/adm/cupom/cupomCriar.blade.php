@extends('adm.base.baseAdmin')


@section('nav')
    <a href="{{ route('admin') }}"><i class="fa-solid fa-box-open"></i> Produtos</a>
    <a href="{{ route('admin.tipos') }}"><i class="fa-solid fa-tags"></i> Categorias</a>
    <a href="{{ route('admin.colecoes') }}"><i class="fa-solid fa-layer-group"></i> Coleções</a>
    <a href="{{ route('lista.cupons') }}"><i class="fa-solid fa-receipt"></i> Cupons</a>
    <a href="{{ route('admin.config') }}"><i class="fa-solid fa-address-book"></i> Contato</a>
    <a href="{{ route('logout') }}"><i class="fa-solid fa-right-from-bracket"></i> Sair</a>
@endsection

@section('content')
    <div class="title">
        <div class="text-title">
            <h3>Adicionar Novo Cupom</h3>
            <p>Preencha os dados do cupom</p>
        </div>
    </div>

    <div class="form">
        <form action="{{ route('createCupom') }}" method="post">
            @csrf
            <div class="box-input">
                <label for="nome">Código do Cupom</label>
                <input id="nome" type="text" name="cupom" placeholder="Ex: DESCONTO10">
            </div>

            <div class="box-input">
                <label for="desconto">Desconto</label>
                <input id="desconto" type="number" name="desconto" placeholder="Insira o valor apenas em numero EX: 10">
            </div>

            <div class="box-input">
                <label for="min">Mínimo de Produtos no Carrinho</label>
                <input id="min" type="number" name="quantidade_minima" placeholder="Quantidade">
            </div>

            <button class="button" type="submit">Criar</button>
        </form>

    </div>
@endsection
