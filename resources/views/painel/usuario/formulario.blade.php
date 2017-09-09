@extends('template.painel')

@section('heading')
    <strong>Adicionar Usu&aacute;rio</strong>
@endsection

@section('content')

    <form id="form-novo-usuario" class="form-horizontal" method="post" action="{{ action('UsuarioController@adiciona') }}">
        {{ csrf_field() }}


        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-md-1 control-label">Nome</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                @if ($errors->has('name'))
                    <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                @endif
            </div>
        </div>


        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="col-md-1 control-label">E-Mail</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                    <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                @endif
            </div>
        </div>


        <div class="form-group{{ $errors->has('perfil_id') ? ' has-error' : '' }}">
            <label for="perfil-id" class="col-md-1 control-label">Perfil</label>

            <div class="col-md-6">

                <select name="perfil_id" class="form-control">
                    <option @if(old('perfil_id')==1) {{'selected="selected"'}} @endif value="1">Administrador</option>
                    <option @if(old('perfil_id')==2) {{'selected="selected"'}} @endif value="2">Cliente</option>
                    <option @if(old('perfil_id')==3) {{'selected="selected"'}} @endif value="3">Propriet&aacute;rio</option>
                </select>

                @if ($errors->has('perfil_id'))
                    <span class="help-block"><strong>{{ $errors->first('perfil_id') }}</strong></span>
                @endif
            </div>
        </div>


        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="col-md-1 control-label">Senha</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control" name="password" required>

                @if ($errors->has('password'))
                    <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                @endif
            </div>
        </div>


        <div class="form-group">
            <label for="password-confirm" class="col-md-1 control-label">Confirmar</label>

            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-2 col-md-offset-1">
                <div class="col-md-6 no-padding">
                    <button type="submit" class="btn btn-primary">
                        Enviar
                    </button>
                </div>
                <div class="col-md-6" style="padding-top: 7px">
                    <a href="#" onclick="javascript:history.back(1);">Voltar</a>
                </div>
            </div>
        </div>
    </form>

@endsection
