@extends('base.base')

@section('title')
<title>LisboaCompany - contatos</title>
@endsection


@section('content')
    <main class="contatos-main-pag">
        <h4>Contatos:</h4>
        <div class="instagram btn">
            <a href="https://www.instagram.com/llisboa.co/"><i class="fa-brands fa-instagram"></i> Instagram</a>
        </div>

        <div class="whatsapp btn">
            <a href="{{ route('encaminhando') }}"><i class="fa-brands fa-whatsapp"></i> WhatsApp</a>
        </div>
    </main>
@endsection