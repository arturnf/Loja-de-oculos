@extends('base.base')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}?v=20">
@endsection


@section('content')
    {{-- Banner dinâmico ou banner padrão --}}
    @if ($bannerDinamico)
        <div class="banner banner-dinamico">
            {{-- Banner Desktop --}}
            @if ($bannerDinamico->img_desktop)
                <div class="banner-desktop banner-container">
                    <div class="banner-skeleton"></div>
                    <a href="{{ $bannerDinamico->link ?? '#' }}" class="banner-link">
                        <img src="{{ asset($bannerDinamico->img_desktop) }}" alt="Banner" loading="lazy" class="banner-img-loading">
                        <div class="banner-overlay">
                            @if ($bannerDinamico->titulo)
                                <h2>{{ $bannerDinamico->titulo }}</h2>
                            @endif
                            @if ($bannerDinamico->texto)
                                <p>{{ $bannerDinamico->texto }}</p>
                            @endif
                            @if ($bannerDinamico->texto_botao)
                                <span class="banner-button">{{ $bannerDinamico->texto_botao}}</span>
                            @endif
                        </div>
                    </a>
                </div>
            @endif

            {{-- Banner Mobile --}}
            @if ($bannerDinamico->img_mobile)
                <div class="banner-mobile banner-container">
                    <div class="banner-skeleton"></div>
                    <a href="{{ $bannerDinamico->link ?? '#' }}" class="banner-link">
                        <img src="{{ asset($bannerDinamico->img_mobile) }}" alt="Banner Mobile" loading="lazy" class="banner-img-loading">
                        <div class="banner-overlay">
                            @if ($bannerDinamico->titulo)
                                <h2>{{ $bannerDinamico->titulo }}</h2>
                            @endif
                            @if ($bannerDinamico->texto)
                                <p>{{ $bannerDinamico->texto }}</p>
                            @endif
                            @if ($bannerDinamico->texto_botao)
                                <span class="banner-button">{{ $bannerDinamico->texto_botao}}</span>
                            @endif
                        </div>
                    </a>
                </div>
            @endif
        </div>
    @else
        {{-- Banner Padrão --}}
        <div class="banner">
            <div class="text-banner">

                <p>Eleve sua performance!</p>
                <a href="{{ route('colecoes') }}">Ver Coleções</a>

            </div>
            <img class="hidden animate__animated" src="{{ asset('img/banner-main.png') }}" alt="" loading="lazy">
        </div>
    @endif
    <main>
        <div class="container-produtos">

            @foreach ($categorias as $categoria)
                <div class="categoria">
                    <div class="titulo">
                        <h4>{{ $categoria->nome }}</h4>
                        <a href="{{ route('lojaCategoria', ['id' => $categoria->id]) }}">Ver Mais ></a>
                    </div>
                    <div class="produtos">
                        @foreach ($categoria->produtos->sortByDesc('id')->take(5) as $produto)
                            <div class="produto">
                                @if ($produto->esgotado)
                                    <div class="esgot font-secundaria">
                                        <p>ESGOTADO</p>
                                    </div>
                                @endif


                                <div class="prod-img">
                                    <a href="{{ route('pag.produto', ['id' => $produto->id]) }}">
                                        <img src="{{ asset($produto->img) }}" alt="" loading="lazy">
                                    </a>

                                </div>
                                <div class="botao-comprar">
                                    @if ($produto->esgotado)
                                        <a class="e-contato"
                                            href="{{ route('pag.produto', ['id' => $produto->id]) }}">Avise-me</a>
                                    @else
                                        <form action="{{ route('carrinho.addcarrinho') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="idProduto" value="{{ $produto->id }}">
                                            <input type="hidden" name="img" value="{{ $produto->img }}">
                                            <input type="hidden" name="nome" value="{{ $produto->nome }}">
                                            <input type="hidden" name="preco" value="{{ $produto->preco }}">
                                            <input type="hidden" name="quantidade" value="1">
                                            <button type="submit" class="product-button">Comprar</button>
                                        </form>
                                    @endif
                                </div>
                                <div class="nome-produto hiddenT animate__animated">
                                    <p>{{ $produto->nome }}</p>
                                </div>
                                @if ($produto->preco_antigo)
                                    <div class="preco_antigo hiddenT animate__animated">
                                        <p>R$ {{ number_format($produto->preco_antigo, 2, ',', '.') }}</p>
                                    </div>
                                @endif
                                <div class="preco hiddenT animate__animated">
                                    <p>R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

        </div>
    </main>

    <div class="colecao-rec">
        <div class="container-colec">
            <div class="titulo-container-colec">
                <h1>Últimas coleções</h1>
                <p>Confira as novidades mais recentes da nossa linha.</p>
            </div>

            @if ($colecoes->isNotEmpty())
                <div class="colecoes-grid">
                    @foreach ($colecoes as $colecao)
                        <article class="colec">
                            <div class="colec-imagem">
                                <img src="{{ asset($colecao->img) }}" alt="{{ $colecao->nome }}" loading="lazy">
                            </div>
                            <div class="text-colec">
                                <span class="colec-chip">{{ $loop->first ? 'Destaque' : 'Novidade' }}</span>
                                <h1>{{ $colecao->nome }}</h1>
                                @if ($colecao->descricao)
                                    <p>{{ $colecao->descricao }}</p>
                                @endif
                                <a href="{{ route('colecao.show', ['id' => $colecao->id]) }}">Ver coleção</a>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <div class="session-av">
        <div class="container">
            <div class="heading">
                <h1>Avaliações dos nossos clientes</h1>
                <div class="sub">Veja comentários reais e prints de WhatsApp</div>
            </div>

            <div class="grid" id="grid">
                <!-- Card 1 -->
                <article class="card">
                    <div class="meta">
                        <div class="left">
                            <div class="badge">WhatsApp</div>
                            <div class="name">Luanny</div>

                        </div>
                        <div class="stars">★★★★★</div>
                    </div>

                    <div class="phone" data-index="0">
                        <div class="phone-inner">
                            <img src="{{ asset('img/Luanny.png') }}" alt="Avaliação Luana" loading="lazy" data-index="0">
                        </div>
                    </div>

                    <div class="caption">
                        <div class="small">"Amei demais!"</div>
                        <div class="small">13:31</div>
                    </div>
                </article>

                <!-- Card 2 -->
                <article class="card">
                    <div class="meta">
                        <div class="left">
                            <div class="badge">WhatsApp</div>
                            <div class="name">Arlindo</div>

                        </div>
                        <div class="stars">★★★★★</div>
                    </div>

                    <div class="phone" data-index="1">
                        <div class="phone-inner">
                            <img src="{{ asset('img/Arlindo.png') }}" alt="Avaliação Tom" loading="lazy" data-index="1">
                        </div>
                    </div>

                    <div class="caption">
                        <div class="small">"Muita Qualidade. Gostei de verdade"</div>
                        <div class="small">19:19</div>
                    </div>
                </article>

                <!-- Card 3 -->
                <article class="card">
                    <div class="meta">
                        <div class="left">
                            <div class="badge">WhatsApp</div>
                            <div class="name">Moniquy</div>

                        </div>
                        <div class="stars">★★★★★</div>
                    </div>

                    <div class="phone" data-index="2">
                        <div class="phone-inner">
                            <img src="{{ asset('img/Moniquy.png') }}" alt="Avaliação Mônica" loading="lazy"
                                data-index="2">
                        </div>
                    </div>

                    <div class="caption">
                        <div class="small">"Inaugurando"</div>
                        <div class="small">05:53</div>
                    </div>
                </article>

            </div>
        </div>

        <!-- Lightbox / Modal -->
        <div class="lightbox" id="lightbox" aria-hidden="true" role="dialog" aria-label="Visualizador de avaliações">
            <div class="lightbox-content" role="document">
                <button class="nav-btn nav-prev" id="prevBtn" aria-label="Anterior">‹</button>
                <img src="" alt="Print ampliado" id="lightboxImg" class="lightbox-img">
                <button class="nav-btn nav-next" id="nextBtn" aria-label="Próximo">›</button>

                <div class="lightbox-bar">
                    <div id="metaInfo" class="small">Cliente — horário</div>
                    <div>
                        <button class="btn" id="closeBtn" aria-label="Fechar">Fechar ✕</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('js')
    <script src="{{ asset('js/home.js') }}"></script>
@endsection
