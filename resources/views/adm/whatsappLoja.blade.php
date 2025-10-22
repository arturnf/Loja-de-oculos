@extends('adm.base.baseAdmin')


@section('nav')
    <a href="{{ route('admin') }}"><i class="fa-solid fa-box-open"></i> Produtos</a>
    <a href="{{ route('admin.tipos') }}"><i class="fa-solid fa-tags"></i> Categorias</a>
    <a href="{{ route('admin.colecoes') }}"><i class="fa-solid fa-layer-group"></i> Coleções</a>
    <a href="{{ route('lista.cupons') }}"><i class="fa-solid fa-receipt"></i> Cupons</a>
    <a href="{{ route('admin.config') }}" class="selected"><i class="fa-solid fa-address-book"></i> Contato</a>
    <a href="{{ route('logout') }}"><i class="fa-solid fa-right-from-bracket"></i> Sair</a>
@endsection


@section('content')
    <div class="title">
        <div class="text-title">
            <h3>Atualizar Contato de Whatsapp</h3>
            <p>Atenção: O número deve ser informado sem traços ou espaços. Exemplo: 5582900000000.</p>
        </div>
    </div>

    <div class="form" enctype="multipart/form-data">
        <form action="{{ route('admin.config.process', ['id' => $numero->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="box-input">
                <label for="nome">Contato</label>
                <input id="nome" type="text" name="numero" value="{{ $numero->numero }}" placeholder="Ex: 5582900000000">
            </div>


            <button class="button" type="submit">Atualizar</button>
        </form>

    </div>
@endsection
