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
        <form action="{{ route('admin.tipos.criando') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="box-input">
                <label for="nome">Nome da Categoria</label>
                <input id="nome" type="text" name="nome" placeholder="Ex: Garrafas">
            </div>


            <button class="button" type="submit">Criar</button>
        </form>

    </div>
@endsection
