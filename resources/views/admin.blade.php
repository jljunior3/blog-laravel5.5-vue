@extends('layouts.app')

@section('content')
<pagina tamanho="8">
    <painel titulo="Notificações">
        <breadcrumbs v-bind:lista="{{$listaPagina}}"></breadcrumbs>
        <div class="row">
            @can('isAutor')
            <div class="col-md-3">
                <caixa qtd="{{ $totalArtigos }}" titulo="Artigos" url="{{ route('artigos.index') }}" cor="orange" icone="ion ion-pie-graph"></caixa>
            </div>
            @endcan

            @can('isAdmin')
            <div class="col-md-3">
                <caixa qtd="{{ $totalUsuarios }}" titulo="Usuários" url="{{ route('usuarios.index') }}" cor="#3b3bad" icone="ion ion-person-stalker"></caixa>
            </div>
            <div class="col-md-3">
                <caixa qtd="{{ $totalAutores }}" titulo="Autores" url="{{ route('autores.index') }}" cor="#d22222" icone="ion ion-person"></caixa>
            </div>
            <div class="col-md-3">
                <caixa qtd="{{ $totalAdmins }}" titulo="Admin" url="{{ route('adm.index') }}" cor="green" icone="ion ion-person"></caixa>
            </div>
            @endcan
        </div>
    </painel>
</pagina>

@endsection


