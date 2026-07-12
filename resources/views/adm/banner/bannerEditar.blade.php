@extends('adm.base.baseAdmin')

@section('nav')
    <a href="{{ route('admin') }}"><i class="fa-solid fa-box-open"></i> Produtos</a>
    <a href="{{ route('admin.banner.editar') }}" class="selected"><i class="fa-solid fa-image"></i> Banner</a>
    <a href="{{ route('admin.tipos') }}"><i class="fa-solid fa-tags"></i> Categorias</a>
    <a href="{{ route('admin.colecoes') }}"><i class="fa-solid fa-layer-group"></i> Coleções</a>
    <a href="{{ route('lista.cupons') }}"><i class="fa-solid fa-receipt"></i> Cupons</a>
    <a href="{{ route('admin.config') }}"><i class="fa-solid fa-address-book"></i> Contato</a>
    <a href="{{ route('logout') }}"><i class="fa-solid fa-right-from-bracket"></i> Sair</a>
@endsection

@section('content')
    <div class="title">
        <div class="text-title">
            <h3>Editar Banner da Home</h3>
            <p>Atualize as imagens, texto e link do banner principal da loja.</p>
        </div>
    </div>

    <div class="form">
        <form action="{{ route('admin.banner.process', ['id' => $banner->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="box-input">
                <label for="titulo">Título</label>
                <input id="titulo" type="text" name="titulo" value="{{ old('titulo', $banner->titulo) }}" placeholder="Ex: Nova coleção">
            </div>

            <div class="box-input">
                <label for="texto">Texto</label>
                <textarea id="texto" name="texto" placeholder="Descreva o banner">{{ old('texto', $banner->texto) }}</textarea>
            </div>

            <div class="box-input">
                <label for="texto_botao">Texto do botão</label>
                <input id="texto_botao" type="text" name="texto_botao" value="{{ old('texto_botao', $banner->texto_botao) }}" placeholder="Ex: Conheça agora">
            </div>

            <div class="box-input">
                <label for="link">Link do botão</label>
                <input id="link" type="text" name="link" value="{{ old('link', $banner->link) }}" placeholder="Ex: /colecoes">
            </div>

            <div class="box-input">
                <label for="ativo">
                    <input id="ativo" type="checkbox" name="ativo" value="1" {{ old('ativo', $banner->ativo) ? 'checked' : '' }}>
                    Banner ativo
                </label>
            </div>

            <div class="box-input-imgs">
                <div class="img-input">
                    <img id="preview" src="{{ $banner->img_desktop ? asset($banner->img_desktop) : asset('img/img-form.png') }}" alt="Banner desktop">
                    <label class="label-file" for="fileInput">Trocar imagem desktop</label>
                    <input class="input-file" id="fileInput" name="img_desktop" type="file" accept="image/*">
                </div>

                <div class="img-input">
                    <img id="preview2" src="{{ $banner->img_mobile ? asset($banner->img_mobile) : asset('img/img-form.png') }}" alt="Banner mobile">
                    <label class="label-file" for="fileInput2">Trocar imagem mobile</label>
                    <input class="input-file" id="fileInput2" name="img_mobile" type="file" accept="image/*">
                </div>
            </div>

            <button class="button" type="submit">Salvar Banner</button>
        </form>
    </div>
@endsection
