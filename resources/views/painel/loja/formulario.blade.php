@extends('template.painel')

@section('heading')
    <strong>Cadastrar Loja</strong>
@endsection

@section('content')

    <form id="form-nova-loja" class="form-horizontal" method="post" action="{{ action('LojaController@adiciona') }}">
        {{ csrf_field() }}
        <input type="hidden" name="user_id" value="{{Auth::id()}}">

        <div class="form-group{{ $errors->has('razao_social') ? ' has-error' : '' }}">
            <label for="razao_social" class="col-md-2 control-label">Raz&atilde;o Social</label>

            <div class="col-md-6">
                <input id="razao_social" type="text" class="form-control" name="razao_social" value="{{ old('razao_social') }}" required autofocus>

                @if ($errors->has('razao_social'))
                    <span class="help-block"><strong>{{ $errors->first('razao_social') }}</strong></span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('nome_fantasia') ? ' has-error' : '' }}">
            <label for="nome_fantasia" class="col-md-2 control-label">Nome Fantasia</label>

            <div class="col-md-6">
                <input id="nome_fantasia" type="text" class="form-control" name="nome_fantasia" value="{{ old('nome_fantasia') }}" required>

                @if ($errors->has('nome_fantasia'))
                    <span class="help-block"><strong>{{ $errors->first('nome_fantasia') }}</strong></span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('nome_representante') ? ' has-error' : '' }}">
            <label for="nome_representante" class="col-md-2 control-label">Nome Representante</label>

            <div class="col-md-6">
                <input id="nome_representante" type="text" class="form-control" name="nome_representante" value="{{ old('nome_representante') }}" required>

                @if ($errors->has('nome_representante'))
                    <span class="help-block"><strong>{{ $errors->first('nome_representante') }}</strong></span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('cpf_representante') ? ' has-error' : '' }}">
            <label for="cpf_representante" class="col-md-2 control-label">CPF Representante</label>

            <div class="col-md-6">
                <input id="cpf_representante" type="text" class="form-control" name="cpf_representante" value="{{ old('cpf_representante') }}" required>

                @if ($errors->has('cpf_representante'))
                    <span class="help-block"><strong>{{ $errors->first('cpf_representante') }}</strong></span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('cnpj') ? ' has-error' : '' }}">
            <label for="cnpj" class="col-md-2 control-label">CNPJ</label>

            <div class="col-md-6">
                <input id="cnpj" type="text" class="form-control" name="cnpj" value="{{ old('cnpj') }}" required>

                @if ($errors->has('cnpj'))
                    <span class="help-block"><strong>{{ $errors->first('cnpj') }}</strong></span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('endereco') ? ' has-error' : '' }}">
            <label for="endereco" class="col-md-2 control-label">Endere&ccedil;o</label>

            <div class="col-md-6">
                <input id="endereco" type="text" class="form-control" name="endereco" value="{{ old('endereco') }}" required>

                @if ($errors->has('endereco'))
                    <span class="help-block"><strong>{{ $errors->first('endereco') }}</strong></span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('bairro') ? ' has-error' : '' }}">
            <label for="bairro" class="col-md-2 control-label">Bairro</label>

            <div class="col-md-6">
                <input id="bairro" type="text" class="form-control" name="bairro" value="{{ old('bairro') }}" required>

                @if ($errors->has('bairro'))
                    <span class="help-block"><strong>{{ $errors->first('bairro') }}</strong></span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('cidade') ? ' has-error' : '' }}">
            <label for="cidade" class="col-md-2 control-label">Cidade</label>

            <div class="col-md-6">
                <input id="cidade" type="text" class="form-control" name="cidade" value="{{ old('cidade') }}" required>

                @if ($errors->has('cidade'))
                    <span class="help-block"><strong>{{ $errors->first('cidade') }}</strong></span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('estado') ? ' has-error' : '' }}">
            <label for="estado" class="col-md-2 control-label">Estado</label>

            <div class="col-md-6">

                <select name="estado" class="form-control">
                    @foreach($estados as $estado)
                        <option @if(old('estado->sigla')==$estado->sigla) {{'selected="selected"'}} @endif value="{{$estado->sigla}}">{{$estado->descricao}}</option>
                    @endforeach
                </select>

                @if ($errors->has('estado'))
                    <span class="help-block"><strong>{{ $errors->first('estado') }}</strong></span>
                @endif
            </div>
        </div>


        <div class="form-group{{ $errors->has('telefone') ? ' has-error' : '' }}">
            <label for="telefone" class="col-md-2 control-label">Telefone</label>

            <div class="col-md-6">
                <input id="telefone" type="text" class="form-control" name="telefone" value="{{ old('telefone') }}" required>

                @if ($errors->has('telefone'))
                    <span class="help-block"><strong>{{ $errors->first('telefone') }}</strong></span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('telefone2') ? ' has-error' : '' }}">
            <label for="telefone2" class="col-md-2 control-label">Telefone 2</label>

            <div class="col-md-6">
                <input id="telefone2" type="text" class="form-control" name="telefone2" value="{{ old('telefone2') }}">

                @if ($errors->has('telefone2'))
                    <span class="help-block"><strong>{{ $errors->first('telefone2') }}</strong></span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-2 col-md-offset-2">
                <div class="col-md-7 no-padding">
                    <button type="submit" class="btn btn-primary">
                        Cadastrar Loja
                    </button>
                </div>
                <div class="col-md-5" style="padding-top: 7px">
                    <a href="#" onclick="javascript:history.back(1);">Voltar</a>
                </div>
            </div>
        </div>
    </form>

@endsection
