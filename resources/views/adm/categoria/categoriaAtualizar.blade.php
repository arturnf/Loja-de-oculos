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
            <h3>Adicionar Nova Categoria</h3>
            <p>Preencha os dados da categoria para categorizar os produtos</p>
        </div>
    </div>

    <div class="form">
        <form action="{{ route('admin.edit.process.tipos', ['id' => $tipo->id]) }}" enctype="multipart/form-data"
            method="POST">
            @csrf
            @method('PUT')
            <div class="box-input">
                <label for="nome">Nome da Categoria</label>
                <input id="nome" type="text" name="nome" value="{{ $tipo->nome }}" placeholder="Ex: Garrafas">
            </div>


            <div class="container-button">
                <button class="button" type="submit">Atualizar</button>
                <a href="#" class="trash btn-excluir">Excluir</a>

                <div class="modal" id="modal-confirmacao">
                    <div class="modal-content">
                        <h2>Confirmar exclusão</h2>
                        <p>Deseja realmente excluir esta categoria?
                            Essa ação também removerá todos os produtos vinculados a ela.</p>

                        <div class="modal-buttons">
                            <div id="cancelar">Cancelar</div>
                            <a href="{{ route('admin.tipos.excluindo', ['id' => $tipo->id]) }}"
                                class="confirmar">Excluir</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
@endsection
