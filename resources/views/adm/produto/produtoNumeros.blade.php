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
            <h1>{{ $produto->nome }}</h1>
            <p>Gerencie o número de cada cliente interessado neste produto</p>
        </div>
    </div>

    <div class="container-list-products">
        <div class="box-list-products">
            <div class="header-list-products">
                <h1>Lista de Contatos</h1>
            </div>


            <table class="tabela-produtos">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Número</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($contatos as $contato)
                    <tr>
                        <td data-label="Nome"><strong>{{ $contato->nome }}</strong></td>
                        <td data-label="Número">{{ $contato->numero }}</td>
                        <td><a class="trashButton" href="{{ route('excluindo.contatos', ['id' => $contato->id, 'produto_id' => $produto->id]) }}"><strong><i class="fa-solid fa-trash"></i></strong> </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

    </div>
@endsection
