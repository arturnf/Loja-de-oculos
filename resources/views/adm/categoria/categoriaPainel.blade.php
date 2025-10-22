@extends('adm.base.baseAdmin')


@section('nav')
    <a href="{{ route('admin') }}"><i class="fa-solid fa-box-open"></i> Produtos</a>
    <a href="{{ route('admin.tipos') }}" class="selected"><i class="fa-solid fa-tags"></i> Categorias</a>
    <a href="{{ route('admin.colecoes') }}"><i class="fa-solid fa-layer-group"></i> Coleções</a>
    <a href="{{ route('lista.cupons') }}"><i class="fa-solid fa-receipt"></i> Cupons</a>
    <a href="{{ route('admin.config') }}"><i class="fa-solid fa-address-book"></i> Contato</a>
    <a href="{{ route('logout') }}"><i class="fa-solid fa-right-from-bracket"></i> Sair</a>
@endsection


@section('content')
    <div class="title">
        <div class="text-title">
            <h1>Categorias</h1>
            <p>Organize seus produtos em categorias</p>
        </div>
        <a href="{{ route('admin.tipos.inserir') }}" class="button-criar">+ Nova Categoria</a>
    </div>

    <div class="infos">
        <div class="box-info">
            <p>Total de Categorias</p>
            <h1>{{ $totalCategoria }}</h1>
        </div>
        <div class="box-info">
            <p>Produtos Categorizados</p>
            <h1>{{ number_format($totalProdutosCat, 0, ',', '.') }}</h1>
        </div>

    </div>

    <div class="container-list-products">
        <div class="box-list-products">
            <div class="header-list-products">
                <h1>Lista de Categorias</h1>
                <p>Gerencie as categorias dos seus produtos</p>
            </div>


            <table class="tabela-produtos">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Produtos</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categoria as $item)
                        <tr>
                            <td data-label="Nome"><strong>{{ $item->nome }}</strong></td>
                            <td data-label="Produtos">{{ $item->produtos->count() }}</td>
                            <td><a class="showButton" href="{{ route('admin.tipos.editar', ['id' => $item->id]) }}"><strong>Ver Categoria</strong> </a></td>
                        </tr>
                    @endforeach


                </tbody>
            </table>

        </div>

    </div>
@endsection
