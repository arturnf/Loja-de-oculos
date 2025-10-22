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

    <div class="form" enctype="multipart/form-data">
        <form action="{{ route('processCupomEdit', ['id' => $cupom->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="box-input">
                <label for="nome">Código do Cupom</label>
                <input id="nome" type="text" name="cupom" value="{{ $cupom->cupom }}" placeholder="Ex: DESCONTO10">
            </div>

            <div class="box-input">
                <label for="desconto">Desconto</label>
                <input id="desconto" name="desconto" type="number" value="{{ $cupom->desconto }}" placeholder="Insira o valor apenas em numero EX: 10">
            </div>

            <div class="box-input">
                <label for="min">Mínimo de Produtos no Carrinho</label>
                <input id="min" name="quantidade_minima" value="{{ $cupom->quantidade_minima }}" type="number" placeholder="Quantidade">
            </div>

            <div class="container-button">
                <button class="button" type="submit">Atualizar</button>
                <a href="#" class="trash btn-excluir">Excluir</a>

                <div class="modal" id="modal-confirmacao">
                    <div class="modal-content">
                        <h2>Confirmar exclusão</h2>
                        <p>Tem certeza que deseja excluir este cupom?</p>

                        <div class="modal-buttons">
                            <div id="cancelar">Cancelar</div>
                            <a href="{{ route('admin.removecupom', ['id' => $cupom->id]) }}" class="confirmar">Excluir</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
@endsection
