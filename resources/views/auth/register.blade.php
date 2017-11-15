@extends('template.site')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Registrar</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nome</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="meuemail@email.com">

                                @if ($errors->has('email'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('cpf') ? ' has-error' : '' }}">
                            <label for="cpf" class="col-md-4 control-label">CPF</label>

                            <div class="col-md-6">
                                <input id="cpf" type="text" class="form-control" name="cpf" value="{{ old('cpf') }}" required autofocus placeholder="123.456.789-10" maxlength="14">

                                @if ($errors->has('cpf'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('cpf') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ \Illuminate\Support\Facades\Session::has('dataNascimento') ? ' has-error' : '' }}">
                            <label for="cpf" class="col-md-4 control-label">Data Nascimento</label>

                            <div class="col-md-6">
                                <input id="dataNascimento" type="text" class="form-control" name="dataNascimento" value="{{ old('dataNascimento') }}" required autofocus placeholder="11/11/1111" maxlength="10">

                                @if (\Illuminate\Support\Facades\Session::has('dataNascimento'))
                                    <span class="text-danger">
                                        <strong>{{ \Illuminate\Support\Facades\Session::get('dataNascimento') }}</strong>
                                    </span>
                                @endif
                                @if ($errors->has('dataNascimento'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('dataNascimento') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('telefone') ? ' has-error' : '' }}">
                            <label for="telefone" class="col-md-4 control-label">Telefone</label>

                            <div class="col-md-6">
                                <input id="telefone" type="text" class="form-control" name="telefone" value="{{ old('telefone') }}" required autofocus placeholder="(11)11111-1111" maxlength="14">

                                @if ($errors->has('telefone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('telefone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group" style="display: none">
                            <div class="col-md-12">
                                <label for="perfil_id" class="col-md-4 control-label">Como quer acessar?</label>
                                <div class="col-md-6">
                                    <label style="padding-top: 6px;">
                                        <input type="radio" name="perfil_id" value="2" checked>Cliente
                                        {{--<input style="margin-left: 10px;" type="radio" name="perfil_id" value="3">Dono de Loja--}}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Senha</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirmar Senha</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Enviar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
