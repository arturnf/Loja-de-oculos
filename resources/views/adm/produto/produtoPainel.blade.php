@extends('adm.base.baseAdmin')


@section('nav')
    <a href="{{ route('admin') }}" class="selected"><i class="fa-solid fa-box-open"></i> Produtos</a>
    <a href="{{ route('admin.tipos') }}"><i class="fa-solid fa-tags"></i> Categorias</a>
    <a href="{{ route('admin.colecoes') }}"><i class="fa-solid fa-layer-group"></i> Coleções</a>
    <a href="{{ route('lista.cupons') }}"><i class="fa-solid fa-receipt"></i> Cupons</a>
    <a href="{{ route('admin.config') }}"><i class="fa-solid fa-address-book"></i> Contato</a>
    <a href="{{ route('logout') }}"><i class="fa-solid fa-right-from-bracket"></i> Sair</a>
@endsection

@section('content')
    <div class="title">
        <div class="text-title">
            <h1>Produtos</h1>
            <p>Gerencie o catálogo de produtos da sua loja</p>
        </div>
        <a href="{{ route('inserir.produto') }}" class="button-criar">+ Novo Produto</a>
    </div>

    <div class="infos">
        <div class="box-info">
            <p>Total de Produtos</p>
            <h1>{{ count($produtos) }}</h1>
        </div>
        <div class="box-info">
            <p>Produtos com Estoque</p>
            <h1>{{ $produtos->where('esgotado', 0)->count() }}</h1>
        </div>

        <div class="box-info">
            <p>Fora de Estoque</p>
            <h1>{{ $produtos->where('esgotado', 1)->count() }}</h1>
        </div>

        <div class="box-info">

            @php
                function formatarValor($valor)
                {
                    if ($valor >= 1000000) {
                        return 'R$ ' . number_format($valor / 1000000, 1) . 'M';
                    } elseif ($valor >= 1000) {
                        return 'R$ ' . number_format($valor / 1000, 1) . 'k';
                    } else {
                        return 'R$ ' . number_format($valor, 2, ',', '.');
                    }
                }
            @endphp


            <p>Valor Total</p>
            <h1 title="R$ {{ number_format($total, 2, ',', '.') }}">{{ formatarValor($total) }}</h1>
        </div>
    </div>

    <div class="container-list-products">
        <div class="box-list-products">
            <div class="header-list-products">
                <h1>Lista de Produtos</h1>
                <p>Visualize e gerencie todos os produtos cadastrados</p>
            </div>

 
            <table class="tabela-produtos px">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th>Preço</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if (!$produtos->isEmpty())
                        @foreach ($produtos as $item)
                            <tr>
                                <td title='{{ $item->nome }}' data-label="Nome"><strong>{{ $item->nome }}</strong></td>
                                <td data-label="Categoria">{{ $item->tipo->nome }}</td>
                                <td data-label="Preço">R$ {{ number_format($item->preco, 2, ',', '.') }}</td>
                                @if (!$item->esgotado)
                                    <td data-label="Status"><span class="status ativo">Com Estoque</span></td>
                                @else
                                    <td data-label="Status"><span class="status inativo">Sem Estoque</span></td>
                                @endif
                                <td><a class="showButton" href="{{ route('admin.edit.produto', ['id' => $item->id]) }}"><strong>Ver Produto</strong> </a></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            @if (!$produtos->isEmpty())
                @foreach ($produtos as $item)
                    <div class="tabela-produto-mobile">
                        <a href="{{ route('admin.edit.produto', ['id' => $item->id]) }}">
                            <div class="produto-mobile">
                                <div class="img-produto-mobile">
                                    <img src="{{ asset($item->img) }}" alt="">
                                </div>
                                <div class="area-nome">
                                    <h1>{{ $item->nome }}</h1>
                                    <p>R$ {{ number_format($item->preco, 2, ',', '.') }}</p>
                                    <p>Categoria: {{ $item->tipo->nome }}</p>
                                </div>

                                @if (!$item->esgotado)
                                    <div class="area-estoque">
                                        <p>Com Estoque</p>
                                    </div>
                                @else
                                    <div class="area-sem-estoque">
                                        <p>Sem Estoque</p>
                                    </div>
                                @endif

                            </div>
                        </a>

                    </div>
                @endforeach
            @endif

        </div>

    </div>
@endsection
