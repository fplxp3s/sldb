@extends('template.painel')

@section('heading')
    @if(!$edita)
        <strong>Detalhes do Produto</strong>
    @else
        <strong>Editar Informa&ccedil;&otilde;es do Produto</strong>
    @endif
@endsection

@section('content')

    @if(!$edita)

        <div class="col-md-3 perfil-usuario text-center">
            <img style="width: 300px; height: 300px" src="{{asset('images/'.$produto->foto->nome_arquivo)}}" alt="{{$produto->nome}}">
            <div class="clearfix"></div>
            <h2>{{$produto->nome}} </h2>
        </div>
        <div class="col-md-7 col-md-offset-1" style="margin-bottom: 30px">
            <ul class="list-unstyled detalhe-usuario">
                <li>
                    <b>Loja:</b> {{$produto->loja->razao_social}}
                </li>
                <li>
                    <b>Categoria:</b> {{$produto->categoria->descricao}}
                </li>
                <li>
                    <b>Nome:</b> {{$produto->nome}}
                </li>
                <li>
                    <b>Pre&ccedil;o:</b> R$ {{$produto->preco}}
                </li>
                <li>
                    <b>Quantidade em Estoque:</b> {{$produto->quantidade}}
                </li>
                <li>
                    <b>&Uacute;ltima atualiza&ccedil;&atilde;o:</b> {{date('d/m/Y H:i:s', strtotime($produto->updated_at))}}
                </li>
            </ul>
            <br>

            <div class="form-group">
                <div class="col-md-6 no-padding">
                    <div class="col-md-3 no-padding">
                        <button type="button" class="btn btn-info"
                                onclick="location.href ='{{action('ProdutoController@edita', $produto->id)}}'">
                            <i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i> Editar
                        </button>
                    </div>
                    <div class="col-md-3 no-padding">
                        <button class="btn btn-danger" type="button" onclick="confirmarExclusao('{{action('ProdutoController@remove', ['id' => $produto->id])}}');">
                            <i class="glyphicon glyphicon-trash"></i> Excluir
                        </button>
                    </div>
                    <div class="col-md-1" style="padding-top: 7px; padding-left: 50px;">
                        <a href="#" onclick="javascript:history.back(1);">Voltar</a>
                    </div>
                </div>
            </div>

        </div>
    @else

        <form id="form-atualiza-produto" class="form-horizontal" method="post" action="{{ action('ProdutoController@atualiza')}}" enctype="multipart/form-data">
            {{ csrf_field() }}

            <input type="hidden" name="id" value="{{$produto->id}}">
            <input type="hidden" name="loja_id" value="{{$produto->loja->id}}">

            <div class="form-group{{ $errors->has('categoria_id') ? ' has-error' : '' }}">
                <label for="categoria_id" class="col-md-1 control-label">Categoria</label>

                <div class="col-md-6">

                    <select name="categoria_id" class="form-control" required autofocus>
                        <option value="">-- Selecione --</option>
                        @foreach($categorias as $categoria)
                            <option @if($produto->categoria_id==$categoria->id) {{'selected="selected"'}} @endif value="{{$categoria->id}}">{{$categoria->descricao}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('categoria_id'))
                        <span class="help-block"><strong>{{ $errors->first('categoria_id') }}</strong></span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                <label for="nome" class="col-md-1 control-label">Nome</label>

                <div class="col-md-6">
                    <input id="nome" class="form-control" name="nome" value="{{ $produto->nome }}" required>

                    @if ($errors->has('nome'))
                        <span class="help-block"><strong>{{ $errors->first('nome') }}</strong></span>
                    @endif
                </div>
            </div>


            <div class="form-group{{ $errors->has('descricao') ? ' has-error' : '' }}">
                <label for="descricao" class="col-md-1 control-label">Descri&ccedil;&atilde;o</label>

                <div class="col-md-6">
                    <textarea id="descricao" class="form-control" name="descricao" required>{{ $produto->descricao }}</textarea>

                    @if ($errors->has('descricao'))
                        <span class="help-block"><strong>{{ $errors->first('descricao') }}</strong></span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('preco') ? ' has-error' : '' }}">
                <label for="preco" class="col-md-1 control-label">Pre&ccedil;o</label>

                <div class="col-md-6">
                    <input id="preco" class="form-control" name="preco" value="{{ $produto->preco }}" required maxlength="9">

                    @if ($errors->has('preco'))
                        <span class="help-block"><strong>{{ $errors->first('preco') }}</strong></span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('quantidade') ? ' has-error' : '' }}">
                <label for="quantidade" class="col-md-1 control-label">Quantidade</label>

                <div class="col-md-6">
                    <input id="quantidade" type="number" class="form-control" name="quantidade" value="{{ $produto->quantidade }}" required maxlength="6">

                    @if ($errors->has('quantidade'))
                        <span class="help-block"><strong>{{ $errors->first('quantidade') }}</strong></span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('foto') ? ' has-error' : '' }}">
                <label for="foto" class="col-md-1 control-label">Foto</label>

                <div class="col-md-6">
                    <input id="foto" type="file" class="form-control" name="foto" value="{{ $produto->foto }}">

                    @if ($errors->has('foto'))
                        <span class="help-block"><strong>{{ $errors->first('foto') }}</strong></span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-2 col-md-offset-1">
                    <div class="col-md-6 no-padding">
                        <button type="submit" class="btn btn-primary">
                            Atualizar Produto
                        </button>
                    </div>
                    <div class="col-md-6" style="padding-top: 7px; padding-left: 55px">
                        <a href="#" onclick="javascript:history.back(1);">Voltar</a>
                    </div>
                </div>
            </div>
        </form>
    @endif

@endsection
