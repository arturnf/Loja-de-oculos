@extends('base.base')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/colecoes.css') }}?v=13">
@endsection


@section('content')
    <section class="colecoes">
        <h2>Nossas Coleções</h2>
        <div class="grid">
        @foreach($colecoes as $colecao)
            <div class="card">
                <img src="{{ asset($colecao->img) }}" alt="Coleção Verão">
                <div class="card-content hiddenT animate__animated">
                    <h3>{{ $colecao->nome }}</h3>
                    <p>{{ $colecao->descricao }}</p>
                    <a href="{{ route('colecao.show', ["id" => $colecao->id]) }}">Ver coleção</a>
                </div>
            </div>
        @endforeach
        </div>
    </section>
@endsection
