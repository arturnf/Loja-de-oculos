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
            <h3>Adicionar Novo Produto</h3>
            <p>Preencha os dados do produto para adicionar ao catálogo</p>
        </div>
    </div>

    <div class="form">
        <form action="{{ route('admin.edit.process.produto', ['id' => $produto->id]) }}" enctype="multipart/form-data"
            method="POST">
            @csrf
            @method('PUT')
            <div class="box-input">
                <label for="nome">Nome do Produto</label>
                <input id="nome" type="text" name="nome" value="{{ $produto->nome }}"
                    placeholder="Ex: Óculos de sol">
            </div>

            <div class="box-input">
                <label for="esgotado">Estoque</label>
                <select id="esgotado" name="esgotado" class="select">
                    @if (!$produto->esgotado)
                        <option value="0" selected>Com Estoque</option>
                        <option value="1">Sem Estoque</option>
                    @else
                        <option value="0">Com Estoque</option>
                        <option value="1" selected>Sem Estoque</option>
                    @endif
                </select>
            </div>

            <div class="box-input">
                <label for="preco">Preço</label>
                <input id="preco" type="number" name="preco" value="{{ $produto->preco }}" step="0.01"
                    placeholder="0.00">
            </div>


            <div class="box-input-number">
                <div class="box-input">
                    <label for="categoria">Categoria</label>
                    <select id="categoria" name="tipo" class="select">
                        @foreach ($tipo as $categoria)
                            @if ($categoria->id == $produto->tipo->id)
                                <option value="{{ $categoria->id }}" selected>{{ $categoria->nome }}</option>
                            @else
                                <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="box-input">
                    <label for="colecao">Coleção</label>
                    <select id="colecao" name="colecao" class="select">
                        @foreach ($colecoes as $colecao)
                            @if ($colecao->id == $produto->colecao_id)
                                <option value="{{ $colecao->id }}" selected>{{ $colecao->nome }}</option>
                            @else
                                <option value="{{ $colecao->id }}">{{ $colecao->nome }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>



            <div class="box-input-imgs">
                <div class="img-input">
                    <img id="preview" src="{{ asset($produto->img) }}" alt="">
                    <label class="label-file" for="fileInput">Inserir Imagem</label>
                    <input class="input-file" id="fileInput" name="img" type="file" accept="image/*">
                </div>

                <div class="img-input">
                    @if ($produto->img2)
                        <img id="preview2" src="{{ asset($produto->img2) }}" alt="">
                    @else
                        <img id="preview2" src="{{ asset('img/img-form.png') }}" alt="">
                    @endif

                    <label class="label-file" for="fileInput2">Inserir Imagem</label>
                    <input class="input-file" id="fileInput2" name="img2" type="file" accept="image/*">
                </div>

                <div class="img-input">
                    @if ($produto->img3)
                        <img id="preview3" src="{{ asset($produto->img3) }}" alt="">
                    @else
                        <img id="preview3" src="{{ asset('img/img-form.png') }}" alt="">
                    @endif
                    <label class="label-file" for="fileInput3">Inserir Imagem</label>
                    <input class="input-file" id="fileInput3" name="img3" type="file" accept="image/*">
                </div>
            </div>


            <div class="container-button">
                <button class="button" type="submit">Atualizar</button>
                <a href="#" class="trash btn-excluir">Excluir</a>

                <div class="modal" id="modal-confirmacao">
                    <div class="modal-content">
                        <h2>Confirmar exclusão</h2>
                        <p>Tem certeza que deseja excluir este produto?</p>

                        <div class="modal-buttons">
                            <div id="cancelar">Cancelar</div>
                            <a href="{{ route('admin.remove.produto', ['id' => $produto->id]) }}" class="confirmar">Excluir</a>
                        </div>
                    </div>
                </div>

                <a href="{{ route('lista.contatos', ['id' => $produto->id]) }}" class="showButtonContato">Ver Contatos</a>
            </div>
        </form>

    </div>
@endsection
