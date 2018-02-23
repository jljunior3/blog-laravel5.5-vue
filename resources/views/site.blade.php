@extends('layouts.app')

@section('content')
    <pagina tamanho="12">
       <painel titulo="Artigos">
            <div class="row">
                @foreach($artigos as $key => $artigo)
                    <artigocard
                            titulo="{{$artigo->titulo}}"
                            descricao="{{$artigo->descricao}}"
                            link="{{route('artigo', [$artigo->id, str_slug($artigo->titulo,'-')])}}"
                            imagem="https://picsum.photos/400/300/?random"
                            data="{{$artigo->data}}"
                            autor="{{$artigo->autor}}"
                            sm="6"
                            md="4"
                    >
                    </artigocard>
                @endforeach
            </div>
            <div align="center">
                {{$artigos}}
            </div>
        </painel>
    </pagina>
@endsection

