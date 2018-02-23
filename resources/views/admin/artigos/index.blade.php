@extends('layouts.app')

@section('content')
    <pagina tamanho="12">

        @if($errors->all())
            @foreach($errors->all() as $key => $value)
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>{{$value}}</strong>
                </div>
            @endforeach
        @endif

        <painel titulo="Lista de Artigos">
            <breadcrumbs v-bind:lista="{{$listaPagina}}"></breadcrumbs>
            <tabela-lista
                    v-bind:titulos="['#','Título','Descrição', 'Data', 'Autor']"
                    v-bind:itens="{{ json_encode($listaArtigos) }}"
                    criar="#criar" detalhe="/admin/artigos/" editar="/admin/artigos/" deletar="/admin/artigos/" token="{{ csrf_token() }}"
                    modal="sim"
            ></tabela-lista>

            <div align="center">
                {{$listaArtigos}}
            </div>
        </painel>
    </pagina>

    <modal nome="adicionar" titulo="Adicionar">
        <formulario id="formAdicionar" css="" action="{{route('artigos.store')}}" method="post" enctype="" token="{{csrf_token()}}">

            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título" value="{{old('titulo')}}">
            </div>
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição" value="{{old('descricao')}}">
            </div>
            <div class="form-group">
                <label for="data">Conteúdo</label>
                {{--<textarea class="form-control" id="conteudoAdd" name="conteudoAdd" placeholder="conteudo">{{old('conteudo')}}</textarea>--}}

                <ckeditor
                        id="conteudoAdd"
                        name="conteudo"
                        value="{{old('conteudo')}}"
                        v-bind:config="{
                        toolbar: [
                          [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript' ]
                        ],
                        height: 200
                        }"
                >
                </ckeditor>

            </div>
            <div class="form-group">
                <label for="data">Data</label>
                <input type="date" class="form-control" id="data" name="data" placeholder="data" value="{{old('data')}}">
            </div>

        </formulario>
        <span slot="botoes">
            <button form="formAdicionar" class="btn btn-info">Adicionar</button>
        </span>
    </modal>

    <modal nome="editar" titulo="Editar">
        <formulario id="formEditar" css="" v-bind:action="'/admin/artigos/' + $store.state.item.id" method="put" enctype="multipart/form-data" token="{{ csrf_token() }}">

            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" v-model="$store.state.item.titulo" placeholder="Título">
            </div>
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <input type="text" class="form-control" id="descricao" name="descricao" v-model="$store.state.item.descricao" placeholder="Descrição">
            </div>
            <div class="form-group">
                <label for="conteudo">Conteúdo</label>
                {{--<textarea class="form-control" id="conteudoEdit" name="conteudoEdit" v-model="$store.state.item.conteudo"></textarea>--}}
                <ckeditor
                        id="conteudoEdit"
                        name="conteudo"
                        v-model="$store.state.item.conteudo"
                        v-bind:config="{
                        toolbar: [
                          [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript' ]
                        ],
                        height: 200
                      }" >
                </ckeditor>
            </div>
            <div class="form-group">
                <label for="descricao">Data</label>
                <input type="date" class="form-control" id="data" name="data" v-model="$store.state.item.data">
            </div>
        </formulario>
        <span slot="botoes">
            <button form="formEditar" class="btn btn-info">Atualizar</button>
        </span>
    </modal>

    <modal nome="detalhe" v-bind:titulo="$store.state.item.titulo">
        <p>@{{$store.state.item.conteudo}}</p>
    </modal>
@endsection

@section('js-especifico')
    {{--CKEDITOR.replace('conteudoAdd');--}}
    {{--CKEDITOR.replace('conteudoEdit');--}}
@endsection