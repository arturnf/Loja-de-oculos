@extends('adm.base.baseAdmin')


@section('nav')
    <a href="{{ route('admin') }}"><i class="fa-solid fa-box-open"></i> Produtos</a>
    <a href="{{ route('admin.tipos') }}"><i class="fa-solid fa-tags"></i> Categorias</a>
    <a href="{{ route('admin.colecoes') }}"><i class="fa-solid fa-layer-group"></i> Coleções</a>
    <a href="{{ route('lista.cupons') }}" class="selected"><i class="fa-solid fa-receipt"></i> Cupons</a>
    <a href="{{ route('admin.config') }}"><i class="fa-solid fa-address-book"></i> Contato</a>
    <a href="{{ route('logout') }}"><i class="fa-solid fa-right-from-bracket"></i> Sair</a>
@endsection

@section('content')
    <div class="title">
        <div class="text-title">
            <h1>Cupons</h1>
            <p>Gerencie cupons de descontos e promoções</p>
        </div>
        <a href="{{ route('formCupom') }}" class="button-criar">+ Novo Cupom</a>
    </div>

    <div class="infos">
        <div class="box-info">
            <p>Total de Cupons</p>
            <h1>{{ number_format($totalCupons, 0, ',', '.') }}</h1>
        </div>
    </div>

    <div class="container-list-products">
        <div class="box-list-products">
            <div class="header-list-products">
                <h1>Lista de Cupons</h1>
                <p>Visualize e gerencie todos os cupons cadastrados</p>
            </div>


            <table class="tabela-produtos">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Desconto</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($cupom as $item)
                    <tr>
                        <td data-label="Nome"><strong>{{ $item->cupom }}</strong></td>
                        <td data-label="Desconto">{{ $item->desconto }}%</td>
                        <td><a class="showButton" href="{{ route('atualizar.cupom', ['id' => $item->id]) }}"><strong>Ver Cupom</strong> </a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
