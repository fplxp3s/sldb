@extends('template.painel')

@section('heading')
    <strong>Cadastrar Produto</strong>
@endsection

@section('content')

    <form id="form-novo-produto" class="form-horizontal" method="post" action="{{ action('ProdutoController@adiciona') }}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <input type="hidden" name="loja_id" value="{{$loja->id}}">

        <div class="form-group{{ $errors->has('categoria_id') ? ' has-error' : '' }}">
            <label for="categoria_id" class="col-md-1 control-label">Categoria</label>

            <div class="col-md-6">

                <select name="categoria_id" class="form-control" required autofocus>
                    <option value="">-- Selecione --</option>
                    @foreach($categorias as $categoria)
                        <option @if(old('categoria_id')==$categoria->id) {{'selected="selected"'}} @endif value="{{$categoria->id}}">{{$categoria->descricao}}</option>
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
                <input id="nome" class="form-control" name="nome" value="{{ old('nome') }}" required>

                @if ($errors->has('nome'))
                    <span class="help-block"><strong>{{ $errors->first('nome') }}</strong></span>
                @endif
            </div>
        </div>


        <div class="form-group{{ $errors->has('descricao') ? ' has-error' : '' }}">
            <label for="descricao" class="col-md-1 control-label">Descri&ccedil;&atilde;o</label>

            <div class="col-md-6">
                <textarea id="descricao" class="form-control" name="descricao" value="{{ old('descricao') }}" required></textarea>

                @if ($errors->has('descricao'))
                    <span class="help-block"><strong>{{ $errors->first('descricao') }}</strong></span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('preco') ? ' has-error' : '' }}">
            <label for="preco" class="col-md-1 control-label">Pre&ccedil;o</label>

            <div class="col-md-6">
                <input id="preco" class="form-control" name="preco" value="{{ old('preco') }}" required maxlength="9">

                @if ($errors->has('preco'))
                    <span class="help-block"><strong>{{ $errors->first('preco') }}</strong></span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('quantidade') ? ' has-error' : '' }}">
            <label for="quantidade" class="col-md-1 control-label">Quantidade</label>

            <div class="col-md-6">
                <input id="quantidade" type="number" class="form-control" name="quantidade" value="{{ old('quantidade') }}" required maxlength="6">

                @if ($errors->has('quantidade'))
                    <span class="help-block"><strong>{{ $errors->first('quantidade') }}</strong></span>
                @endif
            </div>
        </div>

    <div class="form-group{{ $errors->has('foto') ? ' has-error' : '' }}">
        <label for="foto" class="col-md-1 control-label">Foto</label>

        <div class="col-md-6">
            <input id="foto" type="file" class="form-control" name="foto" value="{{ old('foto') }}" required>

            @if ($errors->has('foto'))
                <span class="help-block"><strong>{{ $errors->first('foto') }}</strong></span>
            @endif
        </div>
    </div>

        <div class="form-group">
            <div class="col-md-2 col-md-offset-1">
                <div class="col-md-6 no-padding">
                    <button type="submit" class="btn btn-primary">
                        Criar Produto
                    </button>
                </div>
                <div class="col-md-6" style="padding-top: 7px">
                    <a href="#" onclick="javascript:history.back(1);">Voltar</a>
                </div>
            </div>
        </div>
    </form>

@endsection
