@extends('base.base')

@section('title')
<title>LisboaGlass - home</title>
@endsection


@section('content')
    <main>
        <div class="title">
            <h1 class=" hidden animate__animated">Coleções</h1>
        </div>

        <div class="container-main">

        @foreach ( $colecao as $item )
             <div class="collection">
                <div class="img-collection">
                    <img src="{{ asset($item->img) }}" alt="">
                </div>
                <div class=" title-collection">
                    <h4 class=" hidden animate__animated">{{ $item->nome }}</h4>
                </div>
                <div class="button hidden animate__animated">
                    <a href="{{ route('colecao.show', ['id' => $item->id]) }}">Ver Coleção</a>
                </div>
            </div>
        @endforeach
           

        </div>
    </main>
@endsection