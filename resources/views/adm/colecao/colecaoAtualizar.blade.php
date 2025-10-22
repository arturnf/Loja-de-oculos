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
            <h3>Adicionar Nova Coleção</h3>
            <p>Preencha os dados da coleção</p>
        </div>
    </div>

    <div class="form">
        <form action="{{ route('admin.process.colecao', ['id'=>$colecao->id]) }}"
            enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')
            <div class="box-input">
                <label for="nome">Nome da Coleção</label>
                <input id="nome" type="text" name="nome" value="{{ $colecao->nome }}" placeholder="Ex: Coleção Snow">
            </div>

            <div class="box-input">
                <label for="descricao">Descrição</label>
                <textarea id="descricao" name="descricao" placeholder="Descrição da coleção">{{ $colecao->descricao }}</textarea>
            </div>


            <div class="box-input-imgs">
                <div class="img-input">
                    @if ($colecao->img)
                        <img id="preview" src="{{ asset($colecao->img) }}" alt="">
                    @else
                        <img id="preview" src="{{ asset('img/img-form.png') }}" alt="">
                    @endif

                    <label class="label-file" for="fileInput">Inserir Imagem</label>
                    <input class="input-file" id="fileInput" name="img" type="file" accept="image/*">
                </div>
            </div>


            <div class="container-button">
                <button class="button" type="submit">Atualizar</button>
                <a href="#" class="trash btn-excluir">Excluir</a>

                <div class="modal" id="modal-confirmacao">
                    <div class="modal-content">
                        <h2>Confirmar exclusão</h2>
                        <p>Deseja realmente excluir esta coleção?
                            Essa ação também removerá todos os produtos vinculados a ela.</p>

                        <div class="modal-buttons">
                            <div id="cancelar">Cancelar</div>
                            <a href="{{ route('admin.remove.colecao', ['id' => $colecao->id]) }}" class="confirmar">Excluir</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
@endsection
