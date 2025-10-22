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
        <form action="{{ route('capturando') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="box-input">
                <label for="nome">Nome do Produto</label>
                <input id="nome" type="text" name="nome" placeholder="Ex: Óculos de sol" required>
            </div>

            <div class="box-input">
                <label for="preco">Preço</label>
                <input id="preco" type="number" name="preco" step="0.01" placeholder="0.00" required>
            </div>


            <div class="box-input-number">
                <div class="box-input">
                    <label for="categoria">Categoria</label>
                    <select id="categoria" name="tipo" class="select" required>
                        <option value="">Selecione uma Categoria</option>
                        @foreach ($tipo as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="box-input">
                    <label for="colecao">Coleção</label>
                    <select id="colecao" name="colecao" class="select">
                        <option value="">Selecione uma Coleção</option>
                        @foreach ($colecoes as $colecao)
                            <option value="{{ $colecao->id }}">{{ $colecao->nome }}</option>
                        @endforeach
                    </select>
                </div>
            </div>



            <div class="box-input-imgs">
                <div class="img-input">
                    <img id="preview" src="{{ asset('img/img-form.png') }}" alt="">
                    <label class="label-file" for="fileInput">Inserir Imagem</label>
                    <input class="input-file" id="fileInput" name="img" type="file" accept="image/*">
                </div>

                <div class="img-input">
                    <img id="preview2" src="{{ asset('img/img-form.png') }}" alt="">
                    <label class="label-file" for="fileInput2">Inserir Imagem</label>
                    <input class="input-file" id="fileInput2" name="img2" type="file" accept="image/*">
                </div>

                <div class="img-input">
                    <img id="preview3" src="{{ asset('img/img-form.png') }}" alt="">
                    <label class="label-file" for="fileInput3">Inserir Imagem</label>
                    <input class="input-file" id="fileInput3" name="img3" type="file" accept="image/*">
                </div>
            </div>


            <button class="button" type="submit">Criar</button>
        </form>

    </div>
@endsection
