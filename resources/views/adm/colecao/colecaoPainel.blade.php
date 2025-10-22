@extends('adm.base.baseAdmin')


@section('nav')
    <a href="{{ route('admin') }}"><i class="fa-solid fa-box-open"></i> Produtos</a>
    <a href="{{ route('admin.tipos') }}"><i class="fa-solid fa-tags"></i> Categorias</a>
    <a href="{{ route('admin.colecoes') }}" class="selected"><i class="fa-solid fa-layer-group"></i> Coleções</a>
    <a href="{{ route('lista.cupons') }}"><i class="fa-solid fa-receipt"></i> Cupons</a>
    <a href="{{ route('admin.config') }}"><i class="fa-solid fa-address-book"></i> Contato</a>
    <a href="{{ route('logout') }}"><i class="fa-solid fa-right-from-bracket"></i> Sair</a>
@endsection

@section('content')
    <div class="title">
        <div class="text-title">
            <h1>Coleções</h1>
            <p>Crie coleções temáticas de produtos</p>
        </div>
        <a href="{{ route('admin.inserir.colecao') }}" class="button-criar">+ Nova Coleção</a>
    </div>

    <div class="infos">
        <div class="box-info">
            <p>Total de Coleções</p>
            <h1>{{ number_format($totalColecoes, 0, ',', '.') }}</h1>
        </div>
        <div class="box-info">
            <p>Produtos em Coleções</p>
            <h1>{{ number_format($totalProdutosColecoes, 0, ',', '.') }}</h1>
        </div>
    </div>

    <div class="container-list-products">
        <div class="box-list-products">
            <div class="header-list-products">
                <h1>Lista de Coleções</h1>
                <p>Visualize e gerencie todas as coleções de produtos</p>
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
                @foreach($colecoes as $colecao)
                    <tr>
                        <td data-label="Nome"><strong>{{ $colecao->nome }}</strong></td>
                        <td data-label="Produtos">{{ $colecao->produtos->count() }}</td>
                        <td><a class="showButton" href="{{ route('admin.editar.colecao', ['id' => $colecao->id]) }}"><strong>Ver Coleção</strong> </a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

    </div>
@endsection
