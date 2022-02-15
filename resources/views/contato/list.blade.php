@extends('layouts.app')

@section('content')
<section>
    <h2>Contatos</h2>

    <section>
        <button class="btn btn-primary" onclick="contato_open_create()" type='button'>Criar contato</button><br><br>
        <div id="list">
            @include('contato.table')
        </div>

    </section>
</section>
@endsection
@section('scripts')
    <script src="{{asset('js/contato.js')}}" defer></script>
@endsection
