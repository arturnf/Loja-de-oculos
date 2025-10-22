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
        <form action="{{ route('admin.capturando.colecao') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="box-input">
                <label for="nome">Nome da Coleção</label>
                <input id="nome" type="text" name="nome" placeholder="Ex: Coleção Snow">
            </div>

            <div class="box-input">
                <label for="descricao">Descrição</label>
                <textarea id="descricao" name="descricao" placeholder="Descrição da coleção"></textarea>
            </div>


            <div class="box-input-imgs">
                <div class="img-input">
                    <img id="preview" src="{{ asset('img/img-form.png') }}" alt="">
                    <label class="label-file" for="fileInput">Inserir Imagem</label>
                    <input class="input-file" id="fileInput" name="img" type="file" accept="image/*">
                </div>
            </div>


            <button class="button" type="submit">Criar</button>
        </form>

    </div>
@endsection
